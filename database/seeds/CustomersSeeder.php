<?php

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
      factory(App\Models\Customer::class, 250)->create();
  }
}
