<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use NotifyModel;

    protected $guarded = [];

    protected $dates = [
        'processed_at'
    ];

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->total;
        });
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function addProduct($payload)
    {
        return $this->items()->forceCreate($payload);
    }
}
