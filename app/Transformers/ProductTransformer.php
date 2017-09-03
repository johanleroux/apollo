<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'report'
    ];

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
            'cost_price'                => round($product->cost_price, 2),
            'retail_price'              => round($product->retail_price, 2),
            'recommended_selling_price' => round($product->recommended_selling_price, 2)
        ];
    }

    /**
    * Include Items
    *
    * @return League\Fractal\ItemResource
    */
    public function includeReport($product)
    {
        return $this->item($product, new ProductReportTransformer);
    }
}
