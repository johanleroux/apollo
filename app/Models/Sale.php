<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use NotifyModel;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A sale has a customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    /**
     * A sale has many sale items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Add a product to the sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addProduct($payload)
    {
        return $this->saleItems()->create($payload);
    }

    /**
     * Sale calculates total
     *
     * @return double
     */
    public function getTotalAttribute()
    {
        return $this->saleItems->sum(function ($item) {
            return $item->total;
        });
    }
}
