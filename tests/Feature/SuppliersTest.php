<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SuppliersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_suppliers()
    {
        $this->withExceptionHandling()
            ->get('/suppliers/1')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/suppliers')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->patch('/suppliers/1/')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->delete('/suppliers/1/')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_suppliers()
    {
        create(Supplier::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/suppliers/1')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->post('/suppliers')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->patch('/suppliers/1/')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->delete('/suppliers/1/')
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_may_view_a_supplier()
    {
        $this->signInAdmin();

        $supplier = create(Supplier::class);

        $this->get('/suppliers/1')
             ->assertStatus(200)
             ->assertSee($supplier->name);
    }

    /** @test */
    function authorized_users_may_create_a_supplier()
    {
        $this->signInAdmin();

        $supplier = make(Supplier::class);

        $this->post('/suppliers', $supplier->toArray());
        $this->assertDatabaseHas('suppliers', $supplier->toArray());
    }

    /** @test */
    function authorized_users_may_update_a_supplier()
    {
        $this->signInAdmin();

        $supplier = create(Supplier::class);

        $this->patch('/suppliers/1/', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
            'lead_time' => 1
        ]);

        $this->assertDatabaseHas('suppliers', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
            'lead_time' => 1
        ]);
    }

    /** @test */
    function authorized_users_may_delete_a_supplier()
    {
        $this->signInAdmin();

        $supplier = create(Supplier::class);

        $this->delete('/suppliers/1')
            ->assertStatus(302);
        $this->assertDatabaseMissing('suppliers', [
            'deleted_at' => null
        ]);
    }
}
