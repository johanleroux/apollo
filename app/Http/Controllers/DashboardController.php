<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function show()
    {
        $query = new \App\Queries\Report();

        $report['recap']          = $query->recap();
        $report['stockQuantity']  = $query->stockQuantity();
        $report['stockValue']     = $query->stockValue();
        $report['estimateMargin'] = $query->estimateMargin();

        $quantity = $query->soldByQuantity($limit = 1)->first();
        $value    = $query->soldByValue($limit = 1)->first();

        $report['quantity'] = [
            'product'  => $quantity->product,
            'quantity' => (int) $quantity->quantity,
        ];

        $report['value'] = [
            'product'  => $value->product,
            'value'    => $value->value,
        ];

        return view('dashboard', compact('report'));
    }
}
