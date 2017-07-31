<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
