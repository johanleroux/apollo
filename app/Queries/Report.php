<?php

namespace App\Queries;

use DB;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\PurchaseItem;

class Report
{
    protected $stockData;

    public function __construct()
    {
        $this->stockData = Product::with([
            'purchaseItems',
            'saleItems'
        ])
        ->get();
    }

    public function stockUnits()
    {
        return $this->stockData->sum(function ($product) {
            return $product->stockQuantity;
        });
    }

    public function stockValue()
    {
        return $this->stockData->sum(function ($product) {
            return $product->stockValue;
        });
    }

    public function estimateMargin()
    {
        return $this->stockData->sum(function ($product) {
            return $product->stockMargin;
        });
    }

    public function yearlyRecap()
    {
        return null;
    }
}
