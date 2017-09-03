<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SalesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_sales()
    {
        $this->withExceptionHandling()
            ->get('/sales/1')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->post('/sales')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_sales()
    {
        create(Sale::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/sales/1')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->post('/sales')
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_may_view_a_sale()
    {
        $this->signInAdmin();

        $sale = create(Sale::class);
        $sale->saleItems()->saveMany(make(SaleItem::class, [], 5));
        $company = create(Company::class);

        $this->get('/sales/1')
             ->assertStatus(200)
             ->assertSee((string)$sale->id)
             ->assertSee($sale->customer->name)
             ->assertSee($company->name);
    }

    /** @test */
    function authorized_users_may_create_a_sale()
    {
        $this->signInAdmin();

        $product = create(Product::class);
        $purchase = create(Purchase::class);
        $purchase->purchaseItems()->save(make(PurchaseItem::class, [
            'product_id' => $product->id,
            'quantity'   => 500,
        ]));
        $customer = create(Customer::class);

        $this->post('/sales', [
            'customer_id'        => $customer->id,
            'product' => [
                1 => [
                    'sku'        => $product->id,
                    'unit_price' => $product->retail_price,
                    'quantity'   => 100,
                ]
            ]
        ]);

        $this->assertDatabaseHas('sales', [
            'customer_id' => $customer->id
        ]);

        $this->assertDatabaseHas('sale_items', [
            'product_id' => $product->id,
            'price'      => $product->retail_price,
            'quantity'   => 100
        ]);
    }
}
