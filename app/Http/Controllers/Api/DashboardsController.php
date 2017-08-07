<?php

namespace App\Http\Controllers\Api;

class DashboardsController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        $report = new \App\Queries\Report;

        $data['stockUnits']     = $report->stockUnits();
        $data['stockValue']     = $report->stockValue();
        $data['estimateMargin'] = $report->estimateMargin();
        $data['yearlyRecap']    = $report->yearlyRecap();

        return response()->json([
            'data' => $data
        ]);
    }
}
