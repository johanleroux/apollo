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
        $salesAbilities = [
            'view-customer',
            'view-product',
            'view-supplier',

            'view-purchase',
            'create-purchase',
            'update-purchase',
            'delete-purchase',

            'view-sale',
            'create-sale'
        ];


        $managerAbilities = [
            'create-customer',
            'update-customer',
            'delete-customer',

            'create-product',
            'update-product',
            'delete-product',

            'create-supplier',
            'update-supplier',
            'delete-supplier',
        ];

        foreach ($salesAbilities as $ability) {
            Bouncer::allow('sales')->to($ability);
            Bouncer::allow('manager')->to($ability);
        }

        foreach ($managerAbilities as $ability) {
            Bouncer::allow('manager')->to($ability);
        }

        $sale = App\Models\User::create([
            'name'           => 'Sale Doe',
            'email'          => 'sale@paradox.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $manager = App\Models\User::create([
            'name'           => 'Manager Doe',
            'email'          => 'manager@paradox.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $admin = App\Models\User::create([
            'name'           => 'Admin Doe',
            'email'          => 'admin@paradox.com',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);

        $sale->assign('sales');
        $manager->assign('manager');
        $admin->assign('admin');
    }
}
