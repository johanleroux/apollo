<?php

namespace App\Transformers;

use App\Models\Purchase;
use League\Fractal\TransformerAbstract;

class PurchaseTransformer extends TransformerAbstract
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
        'supplier',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($purchase)
    {
        return [
            'id'           => $purchase->id,
            'placed_at'    => $purchase->created_at->toDateTimeString(),
            'processed_at' => $purchase->processed_at ? $purchase->processed_at->toDateTimeString() : '',
            'total'        => round($purchase->total, 2),
        ];
    }

    /**
    * Include Supplier
    *
    * @return League\Fractal\ItemResource
    */
    public function includeSupplier(Purchase $purchase)
    {
        $supplier = $purchase->supplier;

        return $this->item($supplier, new SupplierTransformer);
    }

    /**
    * Include Items
    *
    * @return League\Fractal\ItemResource
    */
    public function includeItems(Purchase $purchase)
    {
        $items = $purchase->items;

        return $this->collection($items, new PurchaseItemTransformer);
    }
}
