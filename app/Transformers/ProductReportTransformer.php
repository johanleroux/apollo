<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ProductReportTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($product)
    {
        $query = new \App\Queries\Report;

        return [
            'has_stock'               => $product->hasStock(),
            'has_excess_stock'        => $product->hasExcessStock(),
            'has_stock_out'           => $product->hasStockOut(),
            'has_potential_stock_out' => $product->hasPotentialStockOut(),
            'required_stock'          => round($product->requiredStock()),
            'recap'                   => $query->recap($product->id, 'quantity'),
            'forecast'                => $query->forecast($product->id),
        ];
    }
}
