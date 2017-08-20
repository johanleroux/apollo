<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Product;
use App\Queries\Report;
use App\Models\SaleItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReportTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_sort_by_quantity_sold()
    {
        create(Product::class, [], 2);

        create(SaleItem::class, ['product_id' => 1, 'quantity' => 100, 'created_at' => new Carbon('first day of last month')]);
        create(SaleItem::class, ['product_id' => 2, 'quantity' => 200, 'created_at' => new Carbon('first day of last month')]);
        create(SaleItem::class, ['product_id' => 1, 'quantity' => 150, 'created_at' => new Carbon('first day of last month')]);

        $report = new Report();

        $stats = $report->soldByQuantity();

        $this->assertCount(2, $stats);
        $this->assertEquals(1, $stats->first()->product_id);
        $this->assertEquals(250, $stats->first()->quantity);
        $this->assertEquals(2, $stats->last()->product_id);
        $this->assertEquals(200, $stats->last()->quantity);
    }

    /** @test */
    public function it_can_sort_by_value_sold()
    {
        create(Product::class, [], 2);

        create(SaleItem::class, ['product_id' => 1, 'quantity' => 100, 'price' => 100, 'created_at' => new Carbon('first day of last month')]);
        create(SaleItem::class, ['product_id' => 2, 'quantity' => 100, 'price' => 200, 'created_at' => new Carbon('first day of last month')]);
        create(SaleItem::class, ['product_id' => 1, 'quantity' => 100, 'price' => 150, 'created_at' => new Carbon('first day of last month')]);

        $report = new Report();

        $stats = $report->soldByValue();

        $this->assertCount(2, $stats);
        $this->assertEquals(1, $stats->first()->product_id);
        $this->assertEquals(25000.0, $stats->first()->value);
        $this->assertEquals(2, $stats->last()->product_id);
        $this->assertEquals(20000.0, $stats->last()->value);
    }

    /** @test */
    public function it_can_generate_a_recap_for_a_product()
    {
        create(Product::class);
        create(SaleItem::class, ['product_id' => 1, 'quantity' => 100, 'price' => 100, 'created_at' => new Carbon('first day of last month')]);
        create(SaleItem::class, ['product_id' => 1, 'quantity' => 100, 'price' => 150, 'created_at' => new Carbon('first day of last month')]);

        // $report = new Report();
        //
        // $stats = $report->recap($product_id = 1);
        //
        // dd($stats);
    }
}
