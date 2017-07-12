<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($product)
    {
        return [
            'id'          => $product->id,
            'sku'         => $product->sku,
            'description' => $product->description,
            'price'       => (double) number_format($product->price, 2, '.', ''),
            'created_at'  => $product->created_at->toDateTimeString(),
            'updated_at'  => $product->updated_at->toDateTimeString(),
        ];
    }
}
