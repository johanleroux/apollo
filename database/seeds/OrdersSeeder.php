<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    factory(App\Models\Order::class, 250)->create()->each(function ($o) {
      for ($i=0; $i < rand(1, 10); $i++)
      $o->items()->save(factory(App\Models\OrderItem::class)->make());
    });
  }
}
