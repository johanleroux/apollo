<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
  ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
    'sku'         => strtoupper($faker->unique()->lexify()),
    'description' => $faker->sentence(),
    'price'       => $faker->randomFloat(2, 100, 10000),
  ];
});

$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
    'name'      => $faker->company,
    'telephone' => $faker->phoneNumber,
    'email'     => $faker->email,
    'address'   => $faker->streetAddress,
    'address_2' => $faker->secondaryAddress,
    'city'      => $faker->city,
    'province'  => $faker->state,
    'country'   => $faker->country,
  ];
});

$factory->define(App\Models\Supplier::class, function (Faker\Generator $faker) {
    return [
    'name'      => $faker->company,
    'telephone' => $faker->phoneNumber,
    'email'     => $faker->email,
    'address'   => $faker->streetAddress,
    'address_2' => $faker->secondaryAddress,
    'city'      => $faker->city,
    'province'  => $faker->state,
    'country'   => $faker->country,
  ];
});

$factory->define(App\Models\Purchase::class, function (Faker\Generator $faker) {
    return [
    'supplier_id' => $faker->numberBetween(1, 250),
  ];
});

$factory->define(App\Models\PurchaseItem::class, function (Faker\Generator $faker) {
    return [
    'product_id' => $faker->numberBetween(1, 250),
    'price'      => $faker->randomFloat(2, 100, 10000),
    'quantity'   => $faker->numberBetween(1, 2500),
  ];
});

$factory->define(App\Models\Sale::class, function (Faker\Generator $faker) {
    return [
    'customer_id' => $faker->numberBetween(1, 250),
  ];
});

$factory->define(App\Models\SaleItem::class, function (Faker\Generator $faker) {
    return [
    'product_id' => $faker->numberBetween(1, 250),
    'price'      => $faker->randomFloat(2, 100, 10000),
    'quantity'   => $faker->numberBetween(1, 2500),
  ];
});
