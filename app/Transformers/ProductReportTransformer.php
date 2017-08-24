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
            'recap'    => $query->recap($product->id, 'quantity'),
            'forecast' => $query->forecast($product->id)
        ];
    }
}
