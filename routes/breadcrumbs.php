<?php

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', url('dashboard'));
});

// Customer
Breadcrumbs::register('customer', function ($breadcrumbs) {
    $breadcrumbs->push('Customers', action('CustomersController@index'));
});

// Customer >> Create
Breadcrumbs::register('customer_create', function ($breadcrumbs) {
    $breadcrumbs->parent('customer');
    $breadcrumbs->push('Create', action('CustomersController@create'));
});

// Customer >> Edit
Breadcrumbs::register('customer_edit', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('customer_show', $customer);
    $breadcrumbs->push('Edit', action('CustomersController@edit', $customer));
});

// Customer >> Show
Breadcrumbs::register('customer_show', function ($breadcrumbs, $customer) {
    $breadcrumbs->parent('customer');
    $breadcrumbs->push('[#' . $customer->id . '] ' . $customer->name, action('CustomersController@show', $customer));
});

// Product
Breadcrumbs::register('product', function ($breadcrumbs) {
    $breadcrumbs->push('Products', action('ProductsController@index'));
});

// Product >> Create
Breadcrumbs::register('product_create', function ($breadcrumbs) {
    $breadcrumbs->parent('product');
    $breadcrumbs->push('Create', action('ProductsController@create'));
});

// Product >> Edit
Breadcrumbs::register('product_edit', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('product_show', $product);
    $breadcrumbs->push('Edit', action('ProductsController@edit', $product));
});

// Product >> Show
Breadcrumbs::register('product_show', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('product');
    $breadcrumbs->push('[#' . $product->id . '] ' . $product->name, action('ProductsController@show', $product));
});
