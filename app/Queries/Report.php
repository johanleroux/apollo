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
    protected $endDate;
    protected $startDate;

    public function __construct($preload = true)
    {
        if ($preload) {
            $this->stockData = Product::with([
                'purchaseItems',
                'saleItems'
            ])
            ->get();
        }

        $this->endDate   = new \Carbon\Carbon('last day of last month');
        $this->endDate   = $this->endDate->endOfDay();
        $this->startDate = new \Carbon\Carbon('last day of last month');
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

    public function yearlyRecap($limitToProduct = null)
    {
        $data['startDate'] = $this->startDate->format('j M, Y');
        $data['endDate']   = $this->endDate->format('j M, Y');


        $monthlySales =  SaleItem::select(DB::raw('SUM(price * quantity) value'), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupBy('year', 'month')
                ->whereBetween('created_at', [$this->startDate, $this->endDate]);

        if ($limitToProduct) {
            $monthlySales->where('product_id', $limitToProduct);
        }

        $monthlySales = $monthlySales->get();

        foreach ($monthlySales as $month) {
            $data['labels'][] = date('M', mktime(0, 0, 0, $month->month, 10));
            $data['data'][]   = $month->value;
        }

        return $data;
    }
}
