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
    public function purchase_items()
    {
        return $this->hasMany(PurchaseItem::class)
            ->select('product_id')
            ->select('purchase_id')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('purchase_id');
    }

    /**
     * A product has many open purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function open_purchase_items()
    {
        $purchases = Purchase::where('processed_at', null)->pluck('id');
        return $this->purchase_items()
                ->whereIn('purchase_id', $purchases);
    }

    /**
     * A product has many closed purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function closed_purchase_items()
    {
        $purchases = Purchase::where('processed_at', '!=', null)->pluck('id');
        return $this->purchase_items()
                ->whereIn('purchase_id', $purchases);
    }

    /**
     * A product has many sale items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sale_items()
    {
        return $this->hasMany(SaleItem::class)
            ->select('product_id')
            ->select('sale_id')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('sale_id');
    }

    /**
     * Return last sales of product
     * @param  integer $limit
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function latest_sales($limit = 5)
    {
        return $this->sale_items()
            ->with('sale')
            ->orderBy('sale_id', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Product has a current stock quantity
     *
     * @return int
     */
    public function getStockQuantityAttribute()
    {
        return $this->closed_purchase_items->sum('quantity') - $this->sale_items->sum('quantity');
    }

    /**
     * Product has a current stock value
     *
     * @return double
     */
    public function getStockValueAttribute()
    {
        return $this->stockQuantity * $this->cost_price;
    }

    /**
     * Product has a current stock value
     *
     * @return double
     */
    public function getStockMarginAttribute()
    {
        return $this->stockQuantity * ($this->retail_price - $this->cost_price);
    }
}
