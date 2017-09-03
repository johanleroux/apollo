<?php

namespace App\Models;

use App\Traits\NotifyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use NotifyModel, SoftDeletes;

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
    protected $dates = ['deleted_at'];

    /**
     * Override boot method
     */
    protected static function boot()
    {
        parent::boot();

        // Sort by Name ascending
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    /**
     * A customer has many sales.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
    * A customer has many sale items.
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
    */
    public function saleItems()
    {
        return $this->hasManyThrough(SaleItem::class, Sale::class);
    }

    public function getDetailsPrintAttribute()
    {
        $details = "<strong>$this->name</strong><br>";
        $details .= $this->vat_number ? '<b>VAT #: </b>' . $this->vat_number . '<br>': '';
        $details .= $this->address ? $this->address : '';
        $details .= $this->address_2 ? ', ' . $this->address_2 . '<br>': '';
        $details .= $this->city ? $this->city : '';
        $details .= $this->province ? ', ' . $this->province . '<br>': '';
        $details .= $this->country ? $this->country . '<br>' : '';
        $details .= $this->email ? 'Email: ' . $this->email . '<br>' : '';

        return $details;
    }
}
