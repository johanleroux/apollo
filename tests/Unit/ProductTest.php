<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Forecast;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    protected $product;

    public function setUp()
    {
        parent::setUp();
        $this->product = create(Product::class, [
            'cost_price'   => '100',
            'retail_price' => '150',
        ]);
    }

    public function createPurchase($quantity = 1000, $date = null)
    {
        $date = $date ?: new Carbon;

        $purchase = $this->product
        ->supplier->purchases()
        ->save(make(Purchase::class, [
            'created_at'   => $date,
            'updated_at'   => $date,
            'processed_at' => $date
        ]));

        $purchase->purchaseItems()->save(make(PurchaseItem::class, [
            'product_id' => $this->product->id,
            'price'      => $this->product->cost_price,
            'quantity'   => $quantity,
            'created_at' => $date,
            'updated_at' => $date,
        ]));

        return $purchase;
    }

    public function createOpenPurchase($quantity, $date = null)
    {
        $purchase = $this->createPurchase($quantity, $date);
        $purchase->update([
            'processed_at' => null
        ]);
        return $purchase;
    }

    public function createSale($quantity = 1000, $date = null)
    {
        $date = $date ?: new Carbon;

        $customer = create(Customer::class);

        $sale = $customer->sales()->save(make(Sale::class, [
            'created_at'   => $date,
            'updated_at'   => $date
        ]));

        $sale->saleItems()->save(make(SaleItem::class, [
            'product_id' => $this->product->id,
            'price'      => $this->product->cost_price,
            'quantity'   => $quantity,
            'created_at' => $date,
            'updated_at' => $date,
        ]));

        return $sale;
    }

    /** @test */
    function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            'App\Models\Supplier',
            $this->product->supplier
        );
    }

    /** @test */
    function it_has_many_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->product->purchaseItems
        );
    }

    /** @test */
    function it_has_many_open_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->product->openPurchaseItems
        );
    }

    /** @test */
    function it_has_many_closed_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->product->closedPurchaseItems
        );
    }

    /** @test */
    function it_has_many_saleItems()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->product->saleItems
        );
    }

    /** @test */
    function it_can_get_own_stock_level()
    {
        // Open Purchase Doesn't Effect Stock Quantity
        $purchase = $this->createOpenPurchase(1000);
        $this->assertEquals(0, $this->product->stock_quantity);

        // Closed Purchase Does Effect Stock Quantity
        $purchase->update([
            'processed_at' => \Carbon\Carbon::now()
        ]);
        $this->assertEquals(1000, $this->product->fresh()->stock_quantity);

        // Sale Does Effect Stock Quantity
        $sale = $this->createSale(1000);
        $this->assertEquals(0, $this->product->fresh()->stock_quantity);
    }

    /** @test */
    function it_can_calculate_stock_value()
    {
        $purchase = $this->createPurchase(100);
        $this->assertEquals(10000, $this->product->stock_value);
    }

    /** @test */
    function it_can_calculate_stock_margin()
    {
        $purchase = $this->createPurchase(100);
        $this->assertEquals(5000, $this->product->stock_margin);
    }

    /** @test */
    function it_can_determine_if_it_has_stock()
    {
        $purchase = $this->createPurchase(1000);
        $this->assertTrue($this->product->hasStock());
    }
    
    /** @test */
    function it_can_be_forecasted()
    {
        config()->set('database.default', 'mysql');
        config()->set('database.connections.mysql.database', 'apollo_test');
        \Artisan::call('migrate:fresh');

        $this->product = create(Product::class, [
            'cost_price'   => '500',
            'retail_price' => '750',
        ]);

        $date = Carbon::now();
        
        $purchase = $this->createPurchase(50000, Carbon::now()->subMonths(3));

        // Create couple months worth of sales with easy forecastings
        $sale = $this->createSale(500, $date->subMonth());
        $sale = $this->createSale(450, $date->subMonth());
        $sale = $this->createSale(400, $date->subMonth());
        $sale = $this->createSale(500, $date->subMonth());
        $sale = $this->createSale(450, $date->subMonth());
        $sale = $this->createSale(400, $date->subMonth());

        // Assert that their is no forecast
        $this->assertCount(0, Forecast::get());
        
        // Generate forecasting
        dispatch(new \App\Jobs\GenerateForecast($this->product->id));
        
        // Check if next months of forecasts are calculated
        $this->assertCount(10, Forecast::get());

        $this->assertDatabaseHas('forecasts', [
            'forecast' => 400,
            'forecast' => 450,
            'forecast' => 500,
        ]);
    }

    /** @test */
    function it_can_determine_if_it_has_excess_stock()
    {
        // Create purchase with just enough stock
        $purchase = $this->createPurchase(10500, Carbon::now()->subMonths(3));
        
        // Create couple of month sales
        $date = Carbon::now();
        for ($i = 1; $i <= 7; $i++) {
            $sale = $this->createSale((7 - $i) * 500, $date->subMonth());
        }
        
        // Create couple of month forecasts
        $date = Carbon::now();
        for ($i = 1; $i <= 10; $i++) {
            $forecast = create(Forecast::class, [
                'product_id' => $this->product,
                'forecast'   => 3000 + ($i * 500),
                'year'       => $date->year,
                'month'      => $date->month,
            ]);

            $date->addMonth();
        }

        $this->assertFalse($this->product->fresh()->hasExcessStock());
        
        // Create another purchase with to much stock
        $purchase = $this->createPurchase(10500, Carbon::now()->subMonths(3));
        $this->assertTrue($this->product->fresh()->hasExcessStock());
    }

    /** @test */
    function it_can_determine_if_it_has_a_potential_stock_out()
    {
        // Create purchase with just enough stock
        $purchase = $this->createPurchase(10500, Carbon::now()->subMonths(3));
        
        // Create couple of month sales
        $date = Carbon::now();
        for ($i = 1; $i <= 7; $i++) {
            $sale = $this->createSale((7 - $i) * 500, $date->subMonth());
        }
        
        // Create couple of month forecasts
        $date = Carbon::now();
        for ($i = 1; $i <= 10; $i++) {
            $forecast = create(Forecast::class, [
                'product_id' => $this->product,
                'forecast'   => 3000 + ($i * 500),
                'year'       => $date->year,
                'month'      => $date->month,
            ]);

            $date->addMonth();
        }

        $this->assertTrue($this->product->fresh()->hasPotentialStockOut());
        
        // Create another purchase with to much stock
        $purchase = $this->createPurchase(10500, Carbon::now()->subMonths(3));
        $this->assertFalse($this->product->fresh()->hasPotentialStockOut());
    }

    /** @test */
    function it_can_determine_if_it_has_a_stock_out()
    {
        $purchase = $this->createPurchase(1000);
        $this->assertFalse($this->product->fresh()->hasStockOut());
        
        $sale = $this->createSale(1000);
        $this->assertTrue($this->product->fresh()->hasStockOut());
    }
}
