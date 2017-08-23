<?php

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Customer::flushEventListeners();
        Sale::flushEventListeners();

        $products = Product::get();

        // Generate Customers
        factory(Customer::class, 50)
        ->create()
        ->each(function ($c) use ($products) {
            // Generate Sales
            for ($x = 0; $x < 5; $x++) {
                $date = new Carbon\Carbon;
                $date = $date->subMonths(12);
                $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s');

                $c->sales()->save(factory(Sale::class)->make([
                    'created_at' => $date,
                    'updated_at' => $date
                ]));
            }

            $c->sales()->each(function ($s) use ($products) {
                for ($x = 0; $x < 3; $x++) {
                    $product = $products->random();

                    $s->sale_items()->save(factory(SaleItem::class)->make([
                        'product_id' => $product->id,
                        'price'      => $product->recommended_selling_price,
                        'created_at' => $s->created_at,
                        'updated_at' => $s->updated_at
                    ]));
                }
            });
        });
    }
}
