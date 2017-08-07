<?php

namespace App\Transformers;

use App\Models\Sale;
use League\Fractal\TransformerAbstract;

class SaleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'items'
    ];

    /**
    * List of resources to automatically include
    *
    * @var array
    */
    protected $defaultIncludes = [
        'customer',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($sale)
    {
        return [
            'id'           => $sale->id,
            'placed_at'    => $sale->created_at->toDateTimeString(),
            'total'        => (double) number_format($sale->total, 2, '.', ''),
        ];
    }

    /**
    * Include Customer
    *
    * @return League\Fractal\ItemResource
    */
    public function includeCustomer(Sale $sale)
    {
        $customer = $sale->customer;

        return $this->item($customer, new CustomerTransformer);
    }

    /**
    * Include Items
    *
    * @return League\Fractal\ItemResource
    */
    public function includeItems(Sale $sale)
    {
        $items = $sale->items;

        return $this->collection($items, new SaleItemTransformer);
    }
}
