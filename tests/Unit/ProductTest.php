<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    protected $product;

    public function setUp()
    {
        parent::setUp();
        Product::flushEventListeners();
        \App\Models\Supplier::flushEventListeners();
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    function it_belongs_to_supplier()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Model', $this->product->supplier
        );
    }


}
