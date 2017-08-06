<?php

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
      factory(Customer::class, 250)->create();
  }
}
