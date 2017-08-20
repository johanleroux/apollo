<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_products()
    {
        $this->withExceptionHandling()
            ->get('/products/1')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/products')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->patch('/products/1/')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->delete('/products/1/')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_products()
    {
        create(Product::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/products/1')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->post('/products')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->patch('/products/1/')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->delete('/products/1/')
            ->assertStatus(403);
    }

    /** todo */
    function authorized_users_may_view_a_product()
    {
        $this->signInAdmin();

        $product = create(Product::class);

        $this->get('/products/1')
             ->assertStatus(200)
             ->assertSee($product->name);
    }

    /** @test */
    function authorized_users_may_create_a_product()
    {
        $this->signInAdmin();

        $product = make(Product::class);

        $this->post('/products', $product->toArray());
        $this->assertDatabaseHas('products', $product->toArray());
    }

    /** @test */
    function authorized_users_may_update_a_product()
    {
        $this->signInAdmin();

        $product = create(Product::class);

        $this->patch('/products/1/', [
            'description'               => 'Lorem ipsum dolor sit amet.',
            'cost_price'                => '1000',
            'retail_price'              => '1250',
            'recommended_selling_price' => '1250',
        ]);

        $this->assertDatabaseHas('products', [
            'description'               => 'Lorem ipsum dolor sit amet.',
            'cost_price'                => '1000',
            'retail_price'              => '1250',
            'recommended_selling_price' => '1250',
        ]);
    }

    /** @test */
    function authorized_users_may_delete_a_product()
    {
        $this->signInAdmin();

        $product = create(Product::class);

        $this->delete('/products/1')
            ->assertStatus(302);
        $this->assertDatabaseMissing('products', [
            'deleted_at' => null
        ]);
    }
}
