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
            'id'                        => $product->id,
            'sku'                       => $product->sku,
            'description'               => $product->description,
            'cost_price'                => number_format($product->cost_price, 2, '.', ''),
            'retail_price'              => number_format($product->retail_price, 2, '.', ''),
            'recommended_selling_price' => number_format($product->recommended_selling_price, 2, '.', '')
        ];
    }
}
