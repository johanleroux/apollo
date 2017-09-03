<?php

namespace App\Transformers;

use App\Models\PurchaseItem;
use League\Fractal\TransformerAbstract;

class PurchaseItemTransformer extends TransformerAbstract
{
    /**
    * List of resources possible to include
    *
    * @var array
    */
    protected $availableIncludes = [
        'product',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        return [
            'sku'         => $item->product->sku,
            'description' => $item->product->description,
            'quantity'    => $item->quantity,
            'price'       => round($item->price, 2),
            'total'       => round($item->total, 2),
        ];
    }

    /**
    * Include Supplier
    *
    * @return League\Fractal\ItemResource
    */
    public function includeProduct(PurchaseItem $item)
    {
        $product = $item->product;

        return $this->item($product, new ProductTransformer);
    }
}
