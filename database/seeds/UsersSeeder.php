<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    App\Models\User::create([
      'name'           => 'John Doe',
      'email'          => 'johndoe@paradox.com',
      'password'       => bcrypt('secret'),
      'remember_token' => str_random(10),
    ]);

    factory(App\Models\User::class, 50)->create();
  }
}
