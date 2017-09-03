<?php

namespace App\Providers;

use Hash;
use Horizon;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('hash', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        Validator::extend('has_stock', function ($attribute, $value, $parameters, $validator) {
            $field = str_replace('quantity', 'sku', $attribute);

            $product = \App\Models\Product::with([
                    'purchaseItems',
                    'saleItems'
                ])
                ->find(request()->input($field));

            if (!$product) {
                return false;
            }

            return $product->stock_quantity >= $value;
        });

        if (Schema::hasTable('threads')) {
            View::share('share_threads', Thread::getAllLatest()->limit(5)->get());
        }

        Horizon::auth(function ($request) {
            if (auth()->guest()) {
                return false;
            }
            return auth()->user()->isAn('admin');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
