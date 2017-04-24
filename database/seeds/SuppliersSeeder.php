<?php

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
    factory(App\Models\Supplier::class, 250)->create();
  }
}
