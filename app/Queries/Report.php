<?php

namespace App\Queries;

use DB;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Forecast;
use App\Models\SaleItem;
use App\Models\Purchase;
use App\Models\PurchaseItem;

class Report
{
    protected $endDate;
    protected $startDate;
    protected $products = null;

    /**
     * Initialize Report Class
     */
    public function __construct()
    {
        $this->endDate   = new Carbon('last day of last month');
        $this->endDate   = $this->endDate->endOfDay();
        $this->startDate = new Carbon('last day of last month');
        $this->startDate = $this->startDate->subMonths(11)->startOfMonth()->startOfDay();
    }

    /**
     * Sort by value sold in date range
     * @param  integer $limit
     * @return \App\Models\SaleItem
     */
    public function soldByValue($limit = 5)
    {
        return SaleItem::select('product_id', DB::raw('SUM(price * quantity) value'))
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->groupBy('product_id')
                ->orderBy('value', 'desc')
                ->with('product')
                ->limit($limit)
                ->get();
    }

    /**
     * Sort by quantity sold in date range
     * @param  integer $limit
     * @return \App\Models\SaleItem
     */
    public function soldByQuantity($limit = 5)
    {
        return SaleItem::select('product_id', DB::raw('SUM(quantity) quantity'))
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->groupBy('product_id')
                ->orderBy('quantity', 'desc')
                ->with('product')
                ->limit($limit)
                ->get();
    }

    /**
     * Recap sales from date range
     * @param  int $limitToProduct
     * @param  string $type
     * @return array
     */
    public function recap($limitToProduct = null, $type = 'value')
    {
        $data['startDate'] = $this->startDate->format('j M, Y');
        $data['endDate']   = $this->endDate->format('j M, Y');

        $monthlySales =  SaleItem::select(
                DB::raw('SUM(price * quantity) value'),
                DB::raw('SUM(quantity) quantity'),
                DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
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
                $data['data'][] = (double) $sale->$type;
            } else {
                $data['data'][] = 0;
            }
            $date->addMonth();
        }

        return $data;
    }

    /**
     * Get forecast of sales from date range
     * @param  int $limitToProduct
     * @param  string $type
     * @return array
     */
    public function forecast($limitToProduct = null)
    {
        $forecasts =  Forecast::where('month', '>', $this->endDate->month)
                                ->where('year', '>=', $this->endDate->year)
                                ->where('product_id', $limitToProduct)
                                ->get();

        $date = clone $this->startDate;
        while ($date < $this->endDate) {
            $data['labels'][] = $date->format('M - Y');
            $data['data'][] = 0;
            $data['adjusted'][] = 0;

            $date->addMonth();
        }

        foreach ($forecasts as $forecast) {
            $data['labels'][] = date('M', mktime(0, 0, 0, $forecast->month, 10)) . ' - ' . $forecast->year;
            $data['data'][]   = round($forecast->forecast);
            $data['adjusted'][]   = round($forecast->adjusted_forecast);
        }

        return $data;
    }

    /**
     * Load Products into Memory
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function loadProducts()
    {
        if (!$this->products)
        {
            $this->products = Product::with(['closedPurchaseItems', 'saleItems'])->get();
        }
        return $this->products;
    }

    /**
     * Calculate stock quantity
     * @return int
     */
    public function stockQuantity()
    {
        return PurchaseItem::whereIn(
            'purchase_id',
            Purchase::where('processed_at', '!=', null)
                ->pluck('id')
        )->sum('quantity') - SaleItem::sum('quantity');
    }

    /**
     * Calculate stock value
     * @return double
     */
    public function stockValue()
    {
        return $this->loadProducts()->sum(function ($product) {
            return $product->stockValue;
        });
    }

    /**
     * Calculate stock margin
     * @return double
     */
    public function estimateMargin()
    {
        return $this->loadProducts()->sum(function ($product) {
            return $product->stockMargin;
        });
    }
}
