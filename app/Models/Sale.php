<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use NotifyModel;

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->total;
        });
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function addProduct($payload)
    {
        return $this->items()->forceCreate($payload);
    }
}
