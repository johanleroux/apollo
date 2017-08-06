<?php

use App\Models\Supplier;
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
      factory(Supplier::class, 250)->create();
  }
}
