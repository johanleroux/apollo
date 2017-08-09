<?php

namespace App\Queries;

use DB;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Forecast;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\PurchaseItem;

class Report
{
    protected $stockData;
    protected $endDate;
    protected $startDate;

    public function __construct($preload = true)
    {
        if ($preload) {
            $this->stockData = Product::with([
                'purchasedItems',
                'saleItems'
            ])
            ->get();
        }

        $this->endDate   = new Carbon('last day of last month');
        $this->endDate   = $this->endDate->endOfDay();
        $this->startDate = new Carbon('last day of last month');
        $this->startDate = $this->startDate->subMonths(11)->startOfMonth()->startOfDay();
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

    public function topProductByValue()
    {
        return SaleItem::select('product_id', DB::raw('SUM(price * quantity) value'))
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->groupBy('product_id')
                ->orderBy('value', 'desc')
                ->with('product')
                ->first();
    }

    public function topProductByQuantity()
    {
        return SaleItem::select('product_id', DB::raw('SUM(quantity) quantity'))
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->groupBy('product_id')
                ->orderBy('quantity', 'desc')
                ->with('product')
                ->first();
    }

    public function topSellerOfProduct()
    {
        return SaleItem::select('product_id', DB::raw('SUM(price * quantity) value'))
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->groupBy('product_id')
                ->orderBy('value', 'desc')
                ->with('product')
                ->first();
    }

    public function lastSalesOfProduct($product_id, $limit = 5)
    {
        return SaleItem::where('product_id', $product_id)
                        ->with('sale.customer')
                        ->orderBy('created_at', 'desc')
                        ->distinct('sale_id')
                        ->limit($limit)
                        ->get();
    }

    public function unitsInStock($product_id)
    {
        return (int) PurchaseItem::where('product_id', $product_id)
                                 ->sum('quantity')
             - (int) SaleItem::where('product_id', $product_id)
                             ->sum('quantity');
    }

    public function estimateMargin()
    {
        return $this->stockData->sum(function ($product) {
            return $product->stockMargin;
        });
    }

    public function yearlyRecap($limitToProduct = null, $output = 'value')
    {
        $data['startDate'] = $this->startDate->format('j M, Y');
        $data['endDate']   = $this->endDate->format('j M, Y');


        $monthlySales =  SaleItem::select(DB::raw('SUM(price * quantity) value'), DB::raw('SUM(quantity) quantity'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupBy('year', 'month')
                ->whereBetween('created_at', [$this->startDate, $this->endDate]);

        if ($limitToProduct) {
            $monthlySales->where('product_id', $limitToProduct);
        }

        $monthlySales = $monthlySales->get();

        $date = clone $this->startDate;

        while ($date < $this->endDate) {
            $data['labels'][] = $date->format('M - Y');

            if ($sale = $monthlySales->where('month', $date->month)->where('year', $date->year)->first()) {
                $data['data'][] = $sale->$output;
            } else {
                $data['data'][] = 0;
            }
            $date->addMonth();
        }

        return $data;
    }

    public function forecast($limitToProduct)
    {
        $forecasts =  Forecast::where('month', '>', $this->endDate->month)
                                ->where('year', '>=', $this->endDate->year)
                                ->where('product_id', $limitToProduct)
                                ->get();

        $date = clone $this->startDate;
        while ($date < $this->endDate) {
            $data['labels'][] = $date->format('M - Y');
            $data['data'][] = 0;

            $date->addMonth();
        }

        foreach ($forecasts as $forecast) {
            $data['labels'][] = date('M', mktime(0, 0, 0, $forecast->month, 10)) . ' - ' . $forecast->year;
            $data['data'][]   = round($forecast->forecast);
        }

        return $data;
    }
}
