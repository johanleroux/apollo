<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
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
            'cost_price'   => '500',
            'retail_price' => '750',
        ]);
    }

    public function createPurchase($quantity = 1000)
    {
        $purchase = $this->product
        ->supplier->purchases()
        ->save(make(Purchase::class));

        $purchase->purchase_items()->save(make(PurchaseItem::class, [
            'product_id' => $this->product->id,
            'price'      => $this->product->cost_price,
            'quantity'   => $quantity
        ]));

        return $purchase;
    }

    public function createOpenPurchase($quantity)
    {
        $purchase = $this->createPurchase();
        $purchase->update([
            'processed_at' => null
        ]);
        return $purchase;
    }

    public function createSale($quantity = 1000)
    {
        $customer = create(Customer::class);

        $sale = $customer->sales()->save(make(Sale::class));

        $sale->sale_items()->save(make(SaleItem::class, [
            'product_id' => $this->product->id,
            'price'      => $this->product->cost_price,
            'quantity'   => $quantity
        ]));

        return $sale;
    }

    /** @test */
    function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            'App\Models\Supplier', $this->product->supplier
        );
    }

    /** @test */
    function it_has_many_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->product->purchase_items
        );
    }

    /** @test */
    function it_has_many_open_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->product->open_purchase_items
        );
    }

    /** @test */
    function it_has_many_closed_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->product->closed_purchase_items
        );
    }

    /** @test */
    function it_has_many_sale_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->product->sale_items
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
        $this->assertEquals(50000, $this->product->stock_value);
    }

    /** @test */
    function it_can_calculate_stock_margin()
    {
        $purchase = $this->createPurchase(100);
        $this->assertEquals(25000, $this->product->stock_margin);
    }
}
