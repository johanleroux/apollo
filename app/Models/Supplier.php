<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
            $builder->orderBy('name', 'asc');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function getDetailsPrintAttribute()
    {
        $details = "<strong>$this->name</strong><br>";

        $details .= $this->address ? $this->address : '';
        $details .= $this->address_2 ? ', ' . $this->address_2 . '<br>': '';
        $details .= $this->city ? $this->city : '';
        $details .= $this->province ? ', ' . $this->province . '<br>': '';
        $details .= $this->country ? $this->country . '<br>' : '';

        $details .= $this->telephone ? 'Phone: ' . $this->telephone . '<br>' : '';
        $details .= $this->email ? 'Email: ' . $this->email . '<br>' : '';

        return $details;
    }
}
