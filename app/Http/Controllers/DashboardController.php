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

        return view('dashboard', compact('report'));
    }
}
