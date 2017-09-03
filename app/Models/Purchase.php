<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use NotifyModel;

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
    protected $dates = [
        'processed_at'
    ];

    /**
     * A purchase has a supplier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    /**
     * A purchase has many purchase items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Add a product to the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addProduct($payload)
    {
        return $this->purchaseItems()->create($payload);
    }

    /**
     * Purchase calculates total
     *
     * @return double
     */
    public function getTotalAttribute()
    {
        return $this->purchaseItems->sum(function ($item) {
            return $item->total;
        });
    }
}
