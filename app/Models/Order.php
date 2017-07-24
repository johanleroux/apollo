<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = [
        'process_date',
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
        return $this->hasMany(OrderItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
