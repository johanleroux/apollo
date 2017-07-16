@extends('layouts.backend') @section('page-title', 'Dashboard | Apollo') @section('content-header') {!! Breadcrumbs::render('dashboard') !!} @endsection @section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stock Levels</span>
                <span class="info-box-number">78<small>%</small></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stock Value</span>
                <span class="info-box-number">R1,241,410.00</span>
            </div>
        </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Est. Margin</span>
                <span class="info-box-number">R760,000.00</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Order Urgency</span>
                <span class="info-box-number">Low</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Yearly Recap Report</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center"><strong>Stock Levels: 1 Feb, 2016 - 31 Jan, 2017</strong></p>
                        <div class="chart">
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                            <h5 class="description-header">R13,210,532.35</h5>
                            <span class="description-text">TOTAL REVENUE</span>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                            <h5 class="description-header">R8,390,456.90</h5>
                            <span class="description-text">TOTAL COST</span>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">R4,820,075.45</h5>
                            <span class="description-text">TOTAL PROFIT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
