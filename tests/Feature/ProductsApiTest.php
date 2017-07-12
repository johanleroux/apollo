<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $product;

    public function __construct()
    {
        $this->product = [
            'sku'         => 'pSKU',
            'description' => 'pLorem ipsum',
            'price'       => 1337.47,
        ];
    }

    /** @test */
    public function it_can_list_products()
    {
        factory(\App\Models\Product::class, 4)->create();
        factory(\App\Models\Product::class)->create($this->product);

        $this->get('/api/product')
            ->assertJsonFragment(['total' => 5])
            ->assertJsonFragment($this->product)
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_view_a_product()
    {
        $product = factory(\App\Models\Product::class)->create($this->product);

        $this->get('/api/product/' . $product->id)
            ->assertJsonFragment($product->toArray())
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_store_a_product()
    {
        $this->json('POST', '/api/product', $this->product)
            ->assertJsonFragment($this->product)
            ->assertStatus(200);

        $this->assertDatabaseHas('products', $this->product);
    }

    /** @test */
    public function it_validates_storing_of_a_product()
    {
        $this->json('POST', '/api/product', [])
            ->assertJsonFragment(['The sku field is required.'])
            ->assertJsonFragment(['The description field is required.'])
            ->assertJsonFragment(['The price field is required.'])
            ->assertStatus(422);

        $this->json('POST', '/api/product', ['price' => 'aaa'])
            ->assertJsonFragment(['The price must be a number.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = factory(\App\Models\Product::class)->create(['sku' => 'TestSKU']);

        $this->assertDatabaseHas('products', ['sku' => 'TestSKU']);

        $this->json('PATCH', '/api/product/' . $product->id, $this->product)
            ->assertJsonFragment($this->product)
            ->assertStatus(200);

        $this->assertDatabaseHas('products', $this->product);
    }

    /** @test */
    public function it_validates_updating_of_a_product()
    {
        $product = factory(\App\Models\Product::class)->create();

        $this->json('PATCH', '/api/product/' . $product->id, [])
            ->assertJsonFragment(['The sku field is required.'])
            ->assertJsonFragment(['The description field is required.'])
            ->assertJsonFragment(['The price field is required.'])
            ->assertStatus(422);

        $this->json('POST', '/api/product', ['price' => 'aaa'])
            ->assertJsonFragment(['The price must be a number.'])
            ->assertStatus(422);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = factory(\App\Models\Product::class)->create($this->product);

        $this->assertDatabaseHas('products', $this->product);

        $this->json('DELETE', '/api/product/' . $product->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('products', $this->product);
    }
}
