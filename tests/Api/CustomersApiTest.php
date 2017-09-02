<?php

namespace Tests\Api;

use App\Models\Customer;

class CustomersApiTest extends TestCase
{
    protected $customer;

    public function setUp()
    {
        parent::setUp();
        
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
        $customer = create(Customer::class, $this->customer);

        $this->get('/api/customer', [], $this->headers())
            ->assertJsonFragment(['total' => 1])
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_view_a_customer()
    {
        $customer = create(Customer::class, $this->customer);

        $this->get('/api/customer/' . $customer->id, [], $this->headers())
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_customer()
    {
        $this->json('POST', '/api/customer', $this->customer, $this->headers())
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $this->customer);
    }

    /** @test */
    public function it_validates_storing_of_a_customer()
    {
        $this->json('POST', '/api/customer', [], $this->headers())
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $customer = create(Customer::class, ['name' => 'Jane Doe']);

        $this->assertDatabaseHas('customers', ['name' => 'Jane Doe']);

        $this->json('PATCH', '/api/customer/' . $customer->id, $this->customer, $this->headers())
            ->assertJsonFragment($this->customer)
            ->assertStatus(200);

        $this->assertDatabaseHas('customers', $this->customer);
    }

    /** @test */
    public function it_validates_updating_of_a_customer()
    {
        $customer = create(Customer::class);

        $this->json('PATCH', '/api/customer/' . $customer->id, [], $this->headers())
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_delete_a_customer()
    {
        $customer = create(Customer::class, $this->customer);

        $this->assertDatabaseHas('customers', $this->customer);

        $this->json('DELETE', '/api/customer/' . $customer->id, $this->headers())
            ->assertStatus(204);

        $this->assertSoftDeleted('customers', $this->customer);
    }
}
