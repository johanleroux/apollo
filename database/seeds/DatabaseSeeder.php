<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
      $this->call(UsersSeeder::class);
      $this->call(ProductsSeeder::class);
      $this->call(CustomersSeeder::class);
      $this->call(SuppliersSeeder::class);
      $this->call(PurchasesSeeder::class);
      $this->call(SalesSeeder::class);
  }
}
