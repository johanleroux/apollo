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
        $this->customer = factory(Customer::class)->create();
    }

    /** @test */
    function it_has_sales()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->customer->sales
        );
    }
}
