<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SupplierTest extends TestCase
{
    use DatabaseMigrations;

    protected $supplier;

    public function setUp()
    {
        parent::setUp();
        $this->supplier = create(Supplier::class);
    }

    /** @test */
    function it_has_purchases()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->supplier->purchases
        );
    }

    /** @test */
    function it_has_purchase_items()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->supplier->purchase_items
        );
    }

    /** @test */
    function it_has_products()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->supplier->products
        );
    }
}
