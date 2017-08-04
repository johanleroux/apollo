<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SuppliersApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $supplier;

    public function __construct()
    {
        $this->supplier = [
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
    public function it_can_list_suppliers()
    {
        factory(\App\Models\Supplier::class, 4)->create();
        factory(\App\Models\Supplier::class)->create($this->supplier);

        $this->get('/api/supplier')
            ->assertJsonFragment(['total' => 5])
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_view_a_supplier()
    {
        $supplier = factory(\App\Models\Supplier::class)->create($this->supplier);

        $this->get('/api/supplier/' . $supplier->id)
            ->assertJsonFragment($supplier->toArray())
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_supplier()
    {
        $this->json('POST', '/api/supplier', $this->supplier)
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);

        $this->assertDatabaseHas('suppliers', $this->supplier);
    }

    /** @test */
    public function it_validates_storing_of_a_supplier()
    {
        $this->json('POST', '/api/supplier', [])
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_update_a_supplier()
    {
        $supplier = factory(\App\Models\Supplier::class)->create(['name' => 'Jane Doe']);

        $this->assertDatabaseHas('suppliers', ['name' => 'Jane Doe']);

        $this->json('PATCH', '/api/supplier/' . $supplier->id, $this->supplier)
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);

        $this->assertDatabaseHas('suppliers', $this->supplier);
    }

    /** @test */
    public function it_validates_updating_of_a_supplier()
    {
        $supplier = factory(\App\Models\Supplier::class)->create();

        $this->json('PATCH', '/api/supplier/' . $supplier->id, [])
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_delete_a_supplier()
    {
        $supplier = factory(\App\Models\Supplier::class)->create($this->supplier);

        $this->assertDatabaseHas('suppliers', $this->supplier);

        $this->json('DELETE', '/api/supplier/' . $supplier->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('suppliers', $this->supplier);
    }
}
