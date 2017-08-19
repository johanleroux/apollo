<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchaseItemTest extends TestCase
{
    use DatabaseMigrations;

    protected $purchase_item;

    public function setUp()
    {
        parent::setUp();
        $this->purchase_item = create(PurchaseItem::class);
    }

    /** @test */
    function it_belongs_to_a_purchase()
    {
        $this->assertInstanceOf(
            'App\Models\Purchase', $this->purchase_item->purchase
        );
    }

    /** @test */
    function it_belongs_to_a_product()
    {
        $this->assertInstanceOf(
            'App\Models\Product', $this->purchase_item->product
        );
    }

    /** @test */
    function it_can_calculate_total()
    {
        $purchase_item = create(PurchaseItem::class, [
            'quantity' => 3,
            'price'    => 500
        ]);

        $this->assertEquals(1500, $purchase_item->total);
    }
}
