<?php

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

Route::namespace('Api')->group(function () {
    /**
    * Authentication REST
    */
    Route::post('authenticate', 'AuthenticationController@authenticate')->name('authenticate');

    /**
    * Authenticated Group
    */
    Route::middleware(['jwt.auth'])->group(function () {
        /**
        * Customers REST
        */
        Route::apiResource('customer', 'CustomersController');

        /**
        * Suppliers REST
        */
        Route::apiResource('supplier', 'SuppliersController');

        /**
        * Products REST
        */
        Route::apiResource('product', 'ProductsController');

        /**
        * Purchases REST
        */
        Route::apiResource('purchase', 'PurchasesController', ['only' => ['index', 'show']]);

        /**
        * Users REST
        */
        Route::patch('user', 'UsersController@update')->name('user.update');
    });
});
