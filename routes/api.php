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
        Route::resource('customer', 'CustomersController', ['except' => ['create', 'edit']]);

        /**
         * Products REST
         */
        Route::resource('product', 'ProductsController', ['except' => ['create', 'edit']]);
    });
});
