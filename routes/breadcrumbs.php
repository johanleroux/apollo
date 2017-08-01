<?php

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', url('dashboard'));
});

// Company
Breadcrumbs::register('company_edit', function ($breadcrumbs) {
    $breadcrumbs->push('Company Info', action('CompaniesController@edit'));
});

// Settings
Breadcrumbs::register('settings', function ($breadcrumbs) {
    $breadcrumbs->push('User Settings', action('UsersController@edit'));
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

// Supplier
Breadcrumbs::register('supplier', function ($breadcrumbs) {
    $breadcrumbs->push('Suppliers', action('SuppliersController@index'));
});

// Supplier >> Create
Breadcrumbs::register('supplier_create', function ($breadcrumbs) {
    $breadcrumbs->parent('supplier');
    $breadcrumbs->push('Create', action('SuppliersController@create'));
});

// Supplier >> Edit
Breadcrumbs::register('supplier_edit', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('supplier_show', $supplier);
    $breadcrumbs->push('Edit', action('SuppliersController@edit', $supplier));
});

// Supplier >> Show
Breadcrumbs::register('supplier_show', function ($breadcrumbs, $supplier) {
    $breadcrumbs->parent('supplier');
    $breadcrumbs->push('[#' . $supplier->id . '] ' . $supplier->name, action('SuppliersController@show', $supplier));
});

// Purchase
Breadcrumbs::register('purchase', function ($breadcrumbs) {
    $breadcrumbs->push('Purchases', action('PurchasesController@index'));
});

// Purchase >> Create
Breadcrumbs::register('purchase_create', function ($breadcrumbs) {
    $breadcrumbs->parent('purchase');
    $breadcrumbs->push('Create', action('PurchasesController@create'));
});

// Purchase >> Edit
Breadcrumbs::register('purchase_edit', function ($breadcrumbs, $purchase) {
    $breadcrumbs->parent('purchase_show', $purchase);
    $breadcrumbs->push('Edit', action('PurchasesController@edit', $purchase));
});

// Purchase >> Show
Breadcrumbs::register('purchase_show', function ($breadcrumbs, $purchase) {
    $breadcrumbs->parent('purchase');
    $breadcrumbs->push('#' . $purchase->id, action('PurchasesController@show', $purchase));
});

// Sale
Breadcrumbs::register('sale', function ($breadcrumbs) {
    $breadcrumbs->push('Sales', action('SalesController@index'));
});

// Sale >> Create
Breadcrumbs::register('sale_create', function ($breadcrumbs) {
    $breadcrumbs->parent('sale');
    $breadcrumbs->push('Create', action('SalesController@create'));
});

// Sale >> Edit
Breadcrumbs::register('sale_edit', function ($breadcrumbs, $sale) {
    $breadcrumbs->parent('sale_show', $sale);
    $breadcrumbs->push('Edit', action('SalesController@edit', $sale));
});

// Sale >> Show
Breadcrumbs::register('sale_show', function ($breadcrumbs, $sale) {
    $breadcrumbs->parent('sale');
    $breadcrumbs->push('#' . $sale->id, action('SalesController@show', $sale));
});
