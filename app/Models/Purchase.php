<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
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
        return $this->belongsTo(Supplier::class);
    }
}
