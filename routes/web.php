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

    Route::get('/modify_password', function () {
        return view('auth.modify_password');
    });

    Route::resource('customers', 'CustomersController');
    Route::resource('products', 'ProductsController');
    Route::resource('suppliers', 'SuppliersController');
    Route::resource('orders', 'OrdersController');
    Route::resource('purchases', 'PurchasesController');
    Route::resource('sales', 'SalesController');
});
