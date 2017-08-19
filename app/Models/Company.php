<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    public function getDetailsPrintAttribute()
    {
        $details = "<strong>Company Information:</strong><br>";

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
