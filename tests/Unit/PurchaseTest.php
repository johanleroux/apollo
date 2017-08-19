<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchaseTest extends TestCase
{
    use DatabaseMigrations;

    protected $purchase;

    public function setUp()
    {
        parent::setUp();
        $this->purchase = create(Purchase::class);
    }

    /** @test */
    function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            'App\Models\Supplier', $this->purchase->supplier
        );
    }

    /** @test */
    function it_has_many_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->purchase->purchase_items
        );
    }

    /** @test */
    function it_can_add_a_product()
    {
        $this->assertCount(0, $this->purchase->purchase_items);
        $product = create(Product::class);

        $this->purchase->addProduct([
            'product_id'  => $product->id,
            'price'       => 1000,
            'quantity'    => 1,
        ]);

        $this->assertCount(1, $this->purchase->fresh()->purchase_items);
    }

    /** @test */
    function it_can_calculate_total()
    {
        $products = create(Product::class, [], 5);

        $products->each(function($product) {
            $this->purchase->addProduct([
                'product_id'  => $product->id,
                'price'       => 1000,
                'quantity'    => 1,
            ]);
        });

        $this->assertEquals(5000, $this->purchase->total);
    }
}
