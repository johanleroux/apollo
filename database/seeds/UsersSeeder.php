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
            'view-sale',
        ];


        $managerAbilities = [
            'create-customer',
            'edit-customer',
            'delete-customer',

            'create-product',
            'edit-product',
            'delete-product',

            'create-supplier',
            'edit-supplier',
            'delete-supplier',

            'create-purchase',
            'edit-purchase',
            'delete-purchase',

            'create-sale'
        ];

        $adminAbilities = [
            'manage-users',
            'manage-roles',
            'manage-company'
        ];

        $managerAbilities = array_merge($managerAbilities, $salesAbilities);
        $adminAbilities = array_merge($adminAbilities, $managerAbilities);

        foreach ($salesAbilities as $ability) {
            Bouncer::allow('sales')->to($ability);
        }

        foreach ($managerAbilities as $ability) {
            Bouncer::allow('manager')->to($ability);
        }

        foreach ($adminAbilities as $ability) {
            Bouncer::allow('admin')->to($ability);
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

        // factory(App\Models\User::class, 5)->create()->each(function ($user) {
        //     $user->assign('sales');
        // });
    }
}
