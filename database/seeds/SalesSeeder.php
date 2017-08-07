<?php

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
      Sale::flushEventListeners();
      $date = new Carbon\Carbon;
      $date = $date->subMonths(12);
      for ($i=0; $i < 12; $i++) {
          factory(Sale::class, 20)->create([
              'created_at' => $date,
              'updated_at' => $date
              ])->each(function ($p) use ($date) {
                  for ($i=0; $i < rand(1, 10); $i++) {
                      $p->items()->save(factory(App\Models\SaleItem::class)->make([
                          'created_at' => $date,
                          'updated_at' => $date
                          ]));
                  }
              });
          $date = $date->addMonth();
      }
  }
}
