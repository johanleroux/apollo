<?php

$factory->define(App\Models\Company::class, function (Faker\Generator $faker) {
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
    $cost   = $faker->randomFloat(2, 100, 1500);
    $retail = $cost * 1.14 * $faker->randomFloat(2, 1.25, 1.5);
    $rsp    = $retail * $faker->randomFloat(2, 0.9, 1.1);

    return [
        'supplier_id' => function () {
            return factory(App\Models\Supplier::class)->create()->id;
        },
        'sku'                       => strtoupper($faker->unique()->lexify()),
        'description'               => $faker->sentence(),
        'cost_price'                => $cost,
        'retail_price'              => $retail,
        'recommended_selling_price' => $rsp,
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
        'lead_time' => $faker->numberBetween(0, 10),
        'address'   => $faker->streetAddress,
        'address_2' => $faker->secondaryAddress,
        'city'      => $faker->city,
        'province'  => $faker->state,
        'country'   => $faker->country,
    ];
});

$factory->define(App\Models\Purchase::class, function (Faker\Generator $faker) {
    return [
        'supplier_id' => function () {
            return factory(App\Models\Supplier::class)->create()->id;
        },
        'processed_at' => \Carbon\Carbon::now(),
        'ext_invoice'  => $faker->word
    ];
});

$factory->define(App\Models\PurchaseItem::class, function (Faker\Generator $faker) {
    return [
        'purchase_id' => function () {
            return factory(App\Models\Purchase::class)->create()->id;
        },
        'product_id' => function () {
            return factory(App\Models\Product::class)->create()->id;
        },
        'quantity' => $faker->numberBetween(1, 1000),
        'price'    => $faker->numberBetween(1, 1000),
    ];
});

$factory->define(App\Models\Sale::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => function () {
            return factory(App\Models\Customer::class)->create()->id;
        },
    ];
});

$factory->define(App\Models\SaleItem::class, function (Faker\Generator $faker) {
    return [
        'sale_id' => function () {
            return factory(App\Models\Sale::class)->create()->id;
        },
        'product_id' => function () {
            return factory(App\Models\Product::class)->create()->id;
        },
        'quantity' => $faker->numberBetween(1, 1000),
        'price'    => $faker->numberBetween(1, 1000),
    ];
});

$factory->define(App\Models\Forecast::class, function (Faker\Generator $faker) {
    return [
        'product_id' => function () {
            return factory(App\Models\Product::class)->create()->id;
        },
        'forecast'          => $faker->numberBetween(1, 1000),
        'adjusted_forecast' => $faker->numberBetween(1, 1000),
        'year'              => $faker->numberBetween(2017, 2018),
        'month'             => $faker->numberBetween(1, 12),
    ];
});