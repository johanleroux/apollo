<?php

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Supplier::flushEventListeners();
        Product::flushEventListeners();
        Purchase::flushEventListeners();

        // Generate Suppliers
        factory(Supplier::class, 50)
        ->create()
        ->each(function ($s) {
            // Generate Products For Suppliers
            $s->products()->saveMany(factory(Product::class, 5)->make());

            $pc = $s->products()->count();

            // Generate Purchases
            $s->purchases()->saveMany(factory(Purchase::class, 5)->make())
                ->each(function ($p) use ($pc, $s) {
                    for ($i=0; $i < 5; $i++) {
                        $product = $s->products->random();

                        $p->purchase_items()->save(factory(PurchaseItem::class)->make([
                            'product_id' => $product->id,
                            'price'      => $product->cost_price,
                        ]));
                    }
                });
        });
    }
}
