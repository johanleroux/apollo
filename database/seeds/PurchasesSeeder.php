<?php

use Illuminate\Database\Seeder;

class PurchasesSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    factory(App\Models\Purchase::class, 250)->create()->each(function ($p) {
      for ($i=0; $i < rand(1, 10); $i++)
      $p->items()->save(factory(App\Models\PurchaseItem::class)->make());
    });
  }
}
