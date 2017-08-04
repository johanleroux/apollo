<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($customer)
    {
        return [
            'id'         => $customer->id,
            'name'       => $customer->name,
            'telephone'  => $customer->telephone,
            'email'      => $customer->email,
            'address'    => $customer->address,
            'address_2'  => $customer->address_2,
            'city'       => $customer->city,
            'province'   => $customer->province,
            'country'    => $customer->country
        ];
    }
}
