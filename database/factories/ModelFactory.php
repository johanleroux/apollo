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
    $cost = $faker->randomFloat(2, 100, 5000);
    $retail = $cost * 1.14 * $faker->randomFloat(2, 1.25, 1.5);
    $rsp = $retail * $faker->randomFloat(2, 0.9, 1.1);
    return [
    'sku'                       => strtoupper($faker->unique()->lexify()),
    'description'               => $faker->sentence(),
    'cost_price'                => $cost,
    'retail_price'              => $retail,
    'recommended_selling_price' => $rsp,
    'supplier_id'               => $faker->numberBetween(1, 250),
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
