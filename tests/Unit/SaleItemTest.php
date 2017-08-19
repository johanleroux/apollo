<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SaleItemTest extends TestCase
{
    use DatabaseMigrations;

    protected $sale_item;

    public function setUp()
    {
        parent::setUp();
        $this->sale_item = create(SaleItem::class);
    }

    /** @test */
    function it_belongs_to_a_sale()
    {
        $this->assertInstanceOf(
            'App\Models\Sale', $this->sale_item->sale
        );
    }

    /** @test */
    function it_belongs_to_a_product()
    {
        $this->assertInstanceOf(
            'App\Models\Product', $this->sale_item->product
        );
    }

    /** @test */
    function it_can_calculate_total()
    {
        $sale_item = create(SaleItem::class, [
            'quantity' => 3,
            'price'    => 500
        ]);

        $this->assertEquals(1500, $sale_item->total);
    }
}
