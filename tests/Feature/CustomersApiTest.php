<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomersApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $customer;

    public function __construct()
    {
        $this->customer = [
            'name'      => 'John Doe',
            'telephone' => '082 000 000',
            'email'     => 'john@example.com',
            'address'   => '28041 Reinger Lodge',
            'address_2' => 'Apt. 400',
            'city'      => 'Carrollhaven',
            'province'  => 'Delaware',
            'country'   => 'Ethiopia',
        ];
    }

    /** @test */
    public function it_can_list_customers()
    {
        factory(\App\Models\Customer::class, 4)->create();
        factory(\App\Models\Customer::class)->create($this->customer);

        $this->get('/api/customer')
            ->assertJsonFragment(['total' => 5])
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_view_a_customer()
    {
        $customer = factory(\App\Models\Customer::class)->create($this->customer);

        $this->get('/api/customer/' . $customer->id)
            ->assertJsonFragment($customer->toArray())
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_customer()
    {
        $this->json('POST', '/api/customer', $this->customer)
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $this->customer);
    }

    /** @test */
    public function it_validates_storing_of_a_customer()
    {
        $this->json('POST', '/api/customer', [])
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $customer = factory(\App\Models\Customer::class)->create(['name' => 'Jane Doe']);

        $this->assertDatabaseHas('customers', ['name' => 'Jane Doe']);

        $this->json('PATCH', '/api/customer/' . $customer->id, $this->customer)
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $this->customer);
    }

    /** @test */
    public function it_validates_updating_of_a_customer()
    {
        $customer = factory(\App\Models\Customer::class)->create();

        $this->json('PATCH', '/api/customer/' . $customer->id, [])
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_delete_a_customer()
    {
        $customer = factory(\App\Models\Customer::class)->create($this->customer);

        $this->assertDatabaseHas('customers', $this->customer);

        $this->json('DELETE', '/api/customer/' . $customer->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('customers', $this->customer);
    }
}
