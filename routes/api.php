<?php

use Illuminate\Http\Request;

Route::namespace('Api')->group(function () {
    /**
    * Customers REST
    */
    Route::resource('customer', 'CustomersController', ['except' => ['create', 'edit']]);

    /**
     * Products REST
     */
    Route::resource('product', 'ProductsController', ['except' => ['create', 'edit']]);
});
