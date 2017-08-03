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
        $abilities = [
            'land',
            'offbeat',
            'annoyed',
            'grate',
            'cemetery',
            'care',
            'trap',
            'misty',
            'nasty',
            'unfasten',
            'ill',
            'heat',
            'brake',
            'destruction',
            'pets',
            'back',
            'faint',
            'axiomatic',
            'better',
            'sail',
            'recondite',
            'blushing',
            'glistening',
            'yam',
        ];

        foreach ($abilities as $ability) {
            Bouncer::allow('admin')->to($ability);
            Bouncer::allow('manager')->to($ability);
        }

        Bouncer::allow('admin')->to('manage-users');
        Bouncer::allow('manager')->to('manage-users');

        $user = App\Models\User::create([
            'name'           => 'John Doe',
            'email'          => 'johndoe@paradox.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $user->assign('admin');

        factory(App\Models\User::class, 50)->create()->each(function ($user) {
            $user->assign('user');
        });
    }
}
