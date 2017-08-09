<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SupplierTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($supplier)
    {
        return [
            'id'         => $supplier->id,
            'name'       => $supplier->name,
            'telephone'  => $supplier->telephone,
            'email'      => $supplier->email,
            'address'    => $supplier->address,
            'address_2'  => $supplier->address_2,
            'city'       => $supplier->city,
            'province'   => $supplier->province,
            'country'    => $supplier->country,
            'lead_time'  => $supplier->lead_time,
        ];
    }
}
