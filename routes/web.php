<?php

Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Authentication Routes
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('guest')->name('login');
Route::post('login', 'Auth\LoginController@login')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->middleware('guest')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->middleware('guest')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->middleware('guest');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->middleware('guest')->name('password.email');

/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    });

    Route::get('settings', 'UsersController@edit');
    Route::put('settings', 'UsersController@update');

    Route::resource('customers', 'CustomersController');
    Route::resource('products', 'ProductsController');
    Route::resource('suppliers', 'SuppliersController');

    Route::resource('purchases', 'PurchasesController', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update']]);
    Route::post('purchases/{purchase}/process', 'PurchasesController@process');
    Route::resource('sales', 'SalesController', ['only' => ['index', 'show', 'create', 'store']]);

    Route::get('company', 'CompaniesController@edit');
    Route::put('company', 'CompaniesController@update');
});
