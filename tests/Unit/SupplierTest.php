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
        Supplier::flushEventListeners();
        $this->supplier = factory(Supplier::class)->create();
    }

    /** @test */
    function it_has_purchases()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->supplier->purchases
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
