<?php

namespace Tests\Api;

use App\Models\Supplier;

class SuppliersApiTest extends TestCase
{
    protected $supplier;

    public function __construct()
    {
        $this->supplier = [
            'name'      => 'John Doe',
            'telephone' => '082 000 000',
            'email'     => 'john@example.com',
            'lead_time' => '1',
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
        Supplier::flushEventListeners();
        factory(Supplier::class, 4)->create();
        factory(Supplier::class)->create($this->supplier);

        $this->get('/api/supplier', [], $this->headers())
            ->assertJsonFragment(['total' => 5])
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_view_a_supplier()
    {
        Supplier::flushEventListeners();
        $supplier = factory(Supplier::class)->create($this->supplier);

        $this->get('/api/supplier/' . $supplier->id, [], $this->headers())
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_supplier()
    {
        Supplier::flushEventListeners();
        $this->json('POST', '/api/supplier', $this->supplier, $this->headers())
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);

        $this->assertDatabaseHas('suppliers', $this->supplier);
    }

    /** @test */
    public function it_validates_storing_of_a_supplier()
    {
        Supplier::flushEventListeners();
        $this->json('POST', '/api/supplier', [], $this->headers())
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_update_a_supplier()
    {
        Supplier::flushEventListeners();
        $supplier = factory(Supplier::class)->create(['name' => 'Jane Doe']);

        $this->assertDatabaseHas('suppliers', ['name' => 'Jane Doe']);

        $this->json('PATCH', '/api/supplier/' . $supplier->id, $this->supplier, $this->headers())
            ->assertJsonFragment($this->supplier)
            ->assertStatus(200);

        $this->assertDatabaseHas('suppliers', $this->supplier);
    }

    /** @test */
    public function it_validates_updating_of_a_supplier()
    {
        Supplier::flushEventListeners();
        $supplier = factory(Supplier::class)->create();

        $this->json('PATCH', '/api/supplier/' . $supplier->id, [], $this->headers())
            ->assertJsonFragment(['The email field is required.'])
            ->assertJsonFragment(['The name field is required.'])
            ->assertJsonFragment(['The telephone field is required.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_delete_a_supplier()
    {
        Supplier::flushEventListeners();
        $supplier = factory(Supplier::class)->create($this->supplier);

        $this->assertDatabaseHas('suppliers', $this->supplier);

        $this->json('DELETE', '/api/supplier/' . $supplier->id, [], $this->headers())
            ->assertStatus(204);

        $this->assertSoftDeleted('suppliers', $this->supplier);
    }
}
