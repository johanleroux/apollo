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
    function it_has_many_sale_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->sale->sale_items
        );
    }

    /** @test */
    function it_can_add_a_product()
    {
        $this->assertCount(0, $this->sale->sale_items);
        $product = create(Product::class);

        $this->sale->addProduct([
            'product_id'  => $product->id,
            'price'       => 1000,
            'quantity'    => 1,
        ]);

        $this->assertCount(1, $this->sale->fresh()->sale_items);
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

        $this->assertEquals(5000, $this->sale->total);
    }
}
