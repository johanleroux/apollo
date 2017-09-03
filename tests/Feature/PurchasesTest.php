<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchasesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_purchases()
    {
        $this->withExceptionHandling()
            ->get('/purchases/1')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/purchases')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->patch('/purchases/1/')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->delete('/purchases/1/')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_purchases()
    {
        create(Purchase::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/purchases/1')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->post('/purchases')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->patch('/purchases/1/')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->delete('/purchases/1/')
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_may_view_a_purchase()
    {
        $this->signInAdmin();

        $purchase = create(Purchase::class);
        $purchase->purchaseItems()->saveMany(make(PurchaseItem::class, [], 5));
        $company = create(Company::class);

        $this->get('/purchases/1')
             ->assertStatus(200)
             ->assertSee((string)$purchase->id)
             ->assertSee($purchase->supplier->name)
             ->assertSee($company->name);
    }

    /** @test */
    function authorized_users_may_create_a_purchase()
    {
        $this->signInAdmin();

        $product = create(Product::class);

        $this->withExceptionHandling()->post('/purchases', [
            'supplier_id'        => $product->supplier->id,
            'product' => [
                1 => [
                    'sku'        => $product->id,
                    'unit_price' => $product->cost_price,
                    'quantity'   => 100,
                ]
            ]
        ]);

        $this->assertDatabaseHas('purchases', [
            'supplier_id' => $product->supplier->id
        ]);

        $this->assertDatabaseHas('purchase_items', [
            'product_id' => $product->id,
            'price'      => $product->cost_price,
            'quantity'   => 100
        ]);
    }


    /** @test */
    function authorized_users_may_update_a_purchase()
    {
        $this->signInAdmin();

        $purchase = create(Purchase::class, [
            'processed_at' => null
        ]);

        $product = create(Product::class);

        $this->patch('/purchases/1/', [
            'supplier_id'        => $product->supplier->id,
            'product' => [
                1 => [
                    'sku'        => $product->id,
                    'unit_price' => $product->cost_price,
                    'quantity'   => 100,
                ]
            ]
        ]);

        $this->assertDatabaseHas('purchase_items', [
            'product_id' => $product->id,
            'price'      => $product->cost_price,
            'quantity'   => 100
        ]);
    }


    /** @test */
    function authorized_users_may_delete_a_purchase()
    {
        $this->signInAdmin();

        $purchase = create(Purchase::class);

        $this->delete('/purchases/1')
            ->assertStatus(302);
        $this->assertDatabaseMissing('purchases', [
            'deleted_at' => null
        ]);
    }

    /** @test */
    function authorized_users_may_process_a_purchase()
    {
        $this->signInAdmin();

        $purchase = create(Purchase::class, [
            'ext_invoice'  => null,
            'processed_at' => null
        ]);

        $this->assertDatabaseHas('purchases', [
            'ext_invoice'  => null,
            'processed_at' => null
        ]);

        $this->post('/purchases/1/process', [
            'ext_invoice' => 'LOREM'
        ]);

        $this->assertDatabaseMissing('purchases', [
            'ext_invoice'  => null,
            'processed_at' => null
        ]);
    }
}
