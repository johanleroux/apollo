<?php

use Illuminate\Http\Request;

Route::namespace('Api')->group(function () {
    /**
    * Customers REST
    */
    Route::resource('customer', 'CustomersController', ['except' => ['create', 'edit']]);
});
