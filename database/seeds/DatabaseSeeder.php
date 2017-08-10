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
      $this->call(CompaniesSeeder::class);
      $this->call(UsersSeeder::class);
      $this->call(SuppliersSeeder::class);
      $this->call(CustomersSeeder::class);

    //   $productsCount = \App\Models\Product::count();
    //   for ($i = 1; $i <= $productsCount; $i++) {
    //       dispatch(new \App\Jobs\GenerateForecast($i));
    //   }
  }
}
