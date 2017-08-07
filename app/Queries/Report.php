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
        $endDate   = new \Carbon\Carbon('last day of last month');
        $endDate   = $endDate->endOfDay();
        $startDate = new \Carbon\Carbon('last day of last month');
        $startDate = $startDate->subMonths(11)->startOfMonth()->startOfDay();

        $data['startDate'] = $startDate->format('j M, Y');
        $data['endDate']   = $endDate->format('j M, Y');

        $monthlySales =  SaleItem::select(DB::raw('SUM(price * quantity) value'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupBy('year', 'month')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

        foreach ($monthlySales as $month) {
            $data['labels'][] = '"'.(string) date('M', mktime(0, 0, 0, $month->month, 10)).'"';
            $data['data'][]   = $month->value;
        }

        $data['data']   = implode(',', $data['data']);
        $data['labels'] = implode(',', $data['labels']);

        return $data;
    }
}
