<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    protected $customer;

    public function setUp()
    {
        parent::setUp();
        $this->customer = create(Customer::class);
    }

    /** @test */
    function it_has_sales()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->customer->sales
        );
    }

    /** @test */
    function it_has_saleItems()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->customer->saleItems
        );
    }
}
