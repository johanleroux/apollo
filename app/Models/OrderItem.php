<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
