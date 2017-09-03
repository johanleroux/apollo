<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use NotifyModel, SoftDeletes;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Override boot method
     */
    protected static function boot()
    {
        parent::boot();

        // Sort by SKU ascending
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sku', 'asc');
        });
    }

    /**
     * A product has a supplier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    /**
     * A product has many purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems($limit = null)
    {
        return $this->hasMany(PurchaseItem::class)
            ->select(['id', 'product_id', 'purchase_id'])
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('id')
            ->groupBy('purchase_id');
    }

    /**
     * A product has many open purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function openPurchaseItems()
    {
        $purchases = Purchase::where('processed_at', null)->pluck('id');
        return $this->purchaseItems()
                ->whereIn('purchase_id', $purchases);
    }

    /**
     * A product has many closed purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function closedPurchaseItems()
    {
        $purchases = Purchase::where('processed_at', '!=', null)->pluck('id');
        return $this->purchaseItems()
                ->whereIn('purchase_id', $purchases);
    }

    /**
     * A product has many sale items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class)
            ->select(['id', 'product_id', 'sale_id'])
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('id')
            ->groupBy('sale_id');
    }

    /**
     * Return last sales of product
     * @param  integer $limit
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function latestSales($limit = 5)
    {
        return $this->saleItems()
            ->with('sale')
            ->orderBy('sale_id', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Product's current stock quantity
     *
     * @return int
     */
    public function getStockQuantityAttribute()
    {
        return $this->closedPurchaseItems->sum('quantity') - $this->saleItems->sum('quantity');
    }

    /**
     * Product's current stock value
     *
     * @return double
     */
    public function getStockValueAttribute()
    {
        return $this->stockQuantity * $this->cost_price;
    }

    /**
     * Product's current stock value
     *
     * @return double
     */
    public function getStockMarginAttribute()
    {
        return $this->stockQuantity * ($this->retail_price - $this->cost_price);
    }

    /**
     * Product has stock
     *
     * @return boolean
     */
    public function hasStock()
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Product has a excess amount of stock
     *
     * @return boolean
     */
    public function hasExcessStock()
    {
        return false;
    }

    /**
     * Product has a potential to run into a stock out
     * if stock is under predicted forecast
     *
     * @return boolean
     */
    public function hasPotentialStockOut()
    {
        return false;
    }
}
