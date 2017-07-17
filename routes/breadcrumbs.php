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
