<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use NotifyModel, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sku', 'asc');
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class)
            ->select('product_id')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('product_id');
    }

    public function purchasedItems()
    {
        $purchases = Purchase::where('processed_at', '!=', null)->pluck('id');
        return $this->items()
                ->whereIn('purchase_id', $purchases);
    }

    public function openItems()
    {
        $purchases = Purchase::where('processed_at', null)->pluck('id');
        return $this->items()
                ->whereIn('purchase_id', $purchases);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class)
            ->select('product_id')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price) as value')
            ->groupBy('product_id');
    }

    public function getStockQuantityAttribute()
    {
        $purchases = 0;
        $sales = 0;
        if (count($this->purchasedItems) > 0) {
            $purchases = (int) $this->purchasedItems[0]->quantity;
        }

        if (count($this->saleItems) > 0) {
            $sales = (int) $this->saleItems[0]->quantity;
        }
        return $purchases - $sales;
    }

    public function getStockValueAttribute()
    {
        return $this->stockQuantity * $this->cost_price;
    }

    public function getStockMarginAttribute()
    {
        return $this->stockQuantity * ($this->retail_price - $this->cost_price);
    }
}
