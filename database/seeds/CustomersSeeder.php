<?php

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    protected $nCustomers = 50;
    protected $nSales     = 50;
    protected $nSaleItems = 5;

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Customer::flushEventListeners();
        Sale::flushEventListeners();

        // Generate Customers
        factory(Customer::class, $this->nCustomers)
        ->create()
        ->each(function ($c) {
            // Generate Sales For Customers
            $this->generateSales($c, $this->nSales);

            // Generate Sales Items For Customers
            $this->generateSaleItems($c, $this->nSaleItems);
        });
    }

    protected function generateSales($customer, $amount = 50)
    {
        for ($x = 0; $x < $amount; $x++) {
            $date = new Carbon\Carbon;
            $date = $date->subMonths(36);
            $date->addWeeks(rand(1, 52*3))->format('Y-m-d H:i:s');

            $customer
                ->sales()
                ->save(
                    factory(Sale::class)->make([
                        'customer_id'  => $customer,
                        'created_at'   => $date,
                        'updated_at'   => $date
                    ])
                );
        }
    }

    protected function generateSaleItems($customer, $amount = 50)
    {
        $customer
            ->sales
            ->each(function ($sale) use ($customer, $amount) {
                    for($y = 0; $y < $this->nSaleItems; $y++) {
                        $product = Product::inRandomOrder()
                                    ->with(['closed_purchase_items', 'sale_items'])
                                    ->first();

                        $stock = (int) $product->stockQuantity;
                        $stock = $stock < 1000 ?: 1000;

                        if($stock >  0)
                        {
                            // Create Sale Item
                            $sale
                                ->sale_items()
                                ->save(
                                    factory(SaleItem::class)->make([
                                        'sale_id'     => $sale->id,
                                        'product_id'  => $product->id,
                                        'price'       => $product->recommended_selling_price,
                                        'quantity'    => rand(1, $stock),
                                        'created_at'  => $sale->created_at,
                                        'updated_at'  => $sale->created_at
                                    ])
                                );
                        }
                    }
            });
    }
}
