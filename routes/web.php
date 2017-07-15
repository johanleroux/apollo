<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/modify_password', function () {
    return view('auth.modify_password');
});

Route::get('/forget_password', function () {
    return view('auth.forget_password');
});

Route::resource('customers', 'CustomersController');
Route::resource('products', 'ProductsController');
Route::resource('suppliers', 'SuppliersController');
