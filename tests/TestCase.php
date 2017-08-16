<?php

namespace Tests;

use Bouncer;
use JWTAuth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    /**
     * Return request headers needed to interact with the API.
     *
     * @return Array array of headers.
     */
    protected function headers($user = null)
    {
        $headers = ['Accept' => 'application/json'];

        $user = $user ?: $this->admin();

        if (!is_null($user)) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }

    protected function admin()
    {
        $user = factory(\App\Models\User::class)->create();

        $adminAbilities = [
            'view-customer',
            'view-product',
            'view-supplier',

            'view-purchase',
            'create-purchase',
            'edit-purchase',
            'delete-purchase',

            'view-sale',
            'create-sale',
            'create-customer',
            'edit-customer',
            'delete-customer',

            'create-product',
            'edit-product',
            'delete-product',

            'create-supplier',
            'edit-supplier',
            'delete-supplier',
            'manage-users',
            'manage-roles',
            'manage-company'
        ];

        foreach ($adminAbilities as $ability) {
            Bouncer::allow('admin')->to($ability);
        }

        $user->assign('admin');

        return $user;
    }
}
