<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_customers()
    {
        $this->withExceptionHandling()
            ->get('/customers/1')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/customers')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->patch('/customers/1/')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->delete('/customers/1/')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_customers()
    {
        create(Customer::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/customers/1')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->post('/customers')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->patch('/customers/1/')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->delete('/customers/1/')
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_may_view_a_customer()
    {
        $this->signInAdmin();

        $customer = create(Customer::class);

        $this->get('/customers/1')
             ->assertStatus(200)
             ->assertSee($customer->name);
    }

    /** @test */
    function authorized_users_may_create_a_customer()
    {
        $this->signInAdmin();

        $customer = make(Customer::class);

        $this->post('/customers', $customer->toArray());
        $this->assertDatabaseHas('customers', $customer->toArray());
    }

    /** @test */
    function authorized_users_may_update_a_customer()
    {
        $this->signInAdmin();

        $customer = create(Customer::class);

        $this->patch('/customers/1/', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
        ]);

        $this->assertDatabaseHas('customers', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
        ]);
    }

    /** @test */
    function authorized_users_may_delete_a_customer()
    {
        $this->signInAdmin();

        $customer = create(Customer::class);

        $this->delete('/customers/1')
            ->assertStatus(302);
        $this->assertDatabaseMissing('customers', [
            'deleted_at' => null
        ]);
    }
}
