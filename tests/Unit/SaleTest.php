<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SaleTest extends TestCase
{
    use DatabaseMigrations;

    protected $sale;

    public function setUp()
    {
        parent::setUp();
        $this->sale = create(Sale::class);
    }

    /** @test */
    function it_belongs_to_customer()
    {
        $this->assertInstanceOf(
            'App\Models\Customer', $this->sale->customer
        );
    }

    /** @test */
    function it_has_many_saleItems()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->sale->saleItems
        );
    }

    /** @test */
    function it_can_add_a_product()
    {
        $this->assertCount(0, $this->sale->saleItems);
        $product = create(Product::class);

        $this->sale->addProduct([
            'product_id'  => $product->id,
            'price'       => 1000,
            'quantity'    => 1,
        ]);

        $this->assertCount(1, $this->sale->fresh()->saleItems);
    }

    /** @test */
    function it_can_calculate_vat()
    {
        $products = create(Product::class, [], 5);

        $products->each(function($product) {
            $this->sale->addProduct([
                'product_id'  => $product->id,
                'price'       => 1000,
                'quantity'    => 1,
            ]);
        });

        $this->assertEquals(700, $this->sale->vat);
    }

    /** @test */
    function it_can_calculate_sub_total()
    {
        $products = create(Product::class, [], 5);

        $products->each(function($product) {
            $this->sale->addProduct([
                'product_id'  => $product->id,
                'price'       => 1000,
                'quantity'    => 1,
            ]);
        });

        $this->assertEquals(5000, $this->sale->sub_total);
    }

    /** @test */
    function it_can_calculate_total()
    {
        $products = create(Product::class, [], 5);

        $products->each(function($product) {
            $this->sale->addProduct([
                'product_id'  => $product->id,
                'price'       => 1000,
                'quantity'    => 1,
            ]);
        });

        $this->assertEquals(5000*1.14, $this->sale->total);
    }
}
