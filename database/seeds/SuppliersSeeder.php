<?php

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    protected $nSuppliers     = 50;
    protected $nProducts      = 5;
    protected $nPurchases     = 25;
    protected $nPurchaseItems = 5;

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
        factory(Supplier::class, $this->nSuppliers)
        ->create()
        ->each(function ($s) {
            // Generate Products For Suppliers
            $this->generateProducts($s, $this->nProducts);

            // Generate Purchases For Suppliers
            $this->generatePurchases($s, $this->nPurchases);

            // Generate Purchases Items For Suppliers
            $this->generatePurchaseItems($s, $this->nPurchaseItems);
        });
    }

    protected function generateProducts($supplier, $amount = 50)
    {
        return $supplier
                ->products()
                ->saveMany(
                    factory(Product::class, $amount)->make([
                        'supplier_id' => $supplier
                    ])
                );
    }

    protected function generatePurchases($supplier, $amount = 50)
    {
        for ($x = 0; $x < $amount; $x++) {
            $date = new Carbon\Carbon;
            $date = $date->subMonths(36);
            $date->addWeeks(rand(1, 52*3))->format('Y-m-d H:i:s');

            $supplier
                ->purchases()
                ->save(
                    factory(Purchase::class)->make([
                        'supplier_id'  => $supplier,
                        'processed_at' => $date,
                        'created_at'   => $date,
                        'updated_at'   => $date
                    ])
                );
        }
    }

    protected function generatePurchaseItems($supplier, $amount = 50)
    {
        $supplier
            ->purchases
            ->each(function ($purchase) use ($supplier, $amount) {
                for ($y = 0; $y < $this->nPurchaseItems; $y++) {
                    $product = $supplier->products->random();
                    // Create Purchase Item
                    $purchase
                        ->purchaseItems()
                        ->save(
                            factory(PurchaseItem::class)->make([
                                'purchase_id' => $purchase->id,
                                'product_id'  => $product->id,
                                'price'       => $product->cost_price,
                                'created_at'  => $purchase->created_at,
                                'updated_at'  => $purchase->created_at
                            ])
                        );
                }
            });
    }
}
