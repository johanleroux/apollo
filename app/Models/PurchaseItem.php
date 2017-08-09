<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
