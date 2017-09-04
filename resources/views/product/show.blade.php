@extends('layouts.backend') @section('content-header') {!! Breadcrumbs::render('product_show', $product) !!} @if(auth()->user()->isA('manager')
|| auth()->user()->isA('admin'))
<div class="btn-group pull-right">
    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li><a href="{{ action('ProductsController@edit', $product) }}"><i class="fa fa-pencil"></i> Edit</a></li>
        <li><a href="#" onclick="$('#product_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
        {{ html()->form('DELETE', action('ProductsController@destroy', $product))->id('product_destroy')->open() }} {{ html()->form()->close()
        }}
        <li role="presentation" class="divider"></li>
        {{--
        <li><a target="_blank" href="{{ action('CsvController@forecast', $product) }}"><i class="fa fa-external-link"></i> Forecast</a></li>
        --}}
        <li><a target="_blank" href="{{ action('CsvController@recap', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Recap</a></li>
        <li><a target="_blank" href="{{ action('CsvController@sales', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Sales</a></li>
        <li><a target="_blank" href="{{ action('CsvController@purchases', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Purchases</a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="#" data-toggle="modal" data-target="#manualForecast"><i class="fa fa-pencil"></i> Manual Forecast</a></li>
    </ul>
</div>
@endif @endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <li><a href="#account" data-toggle="tab" aria-expanded="false">Account</a></li>
                <li class="active"><a href="#report" data-toggle="tab" aria-expanded="false">Report</a></li>
                <li><a href="{{ action('SuppliersController@show', $product->supplier) }}">Supplier <i class="fa fa-external-link"></i></a></li>
                <li><a href="{{ action('PurchasesController@index', ['product_id' => $product]) }}">Purchases <i class="fa fa-external-link"></i></a></li>
                <li><a href="{{ action('SalesController@index', ['product_id' => $product]) }}">Sales <i class="fa fa-external-link"></i></a></li>
                <li class="pull-left header"><i class="fa fa-shopping-cart"></i> {{ $product->sku }}</li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="account">
                    {{ html()->modelForm($product) }} @include('product._form') {{ html()->closeModelForm() }}
                </div>
                <div class="tab-pane active" id="report">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center"><strong>Monthly Sales: {{ $report['quantity']['startDate'] }} - {{ $report['quantity']['endDate'] }}</strong></p>
                            <div class="chart">
                                <canvas id="yearlyRecap" style="height:300px"></canvas>
                            </div>
                            <small class="pull-right">Last Forecast: {{ $product->last_forecast ?? 'Never' }}</small><br><br>
                        </div>
                    </div>
                    <div class="row">
                        @if($product->hasExcessStock())
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content" style="padding-top: 22px">
                                        <span class="info-box-text">Excess Stock</span>
                                        <span class="info-box-number">{{ number_format($product->stock_quantity) }} <small>{{ str_plural('unit', $product->stock_quantity) }}</small></span>
                                    </div>
                                </div>
                            </div>
                        @elseif($product->hasStockOut())
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content" style="padding-top: 22px">
                                        <span class="info-box-text">Stocked Out</span>
                                        <span class="info-box-number">{{ number_format($product->stock_quantity) }} <small>{{ str_plural('unit', $product->stock_quantity) }}</small></span>
                                    </div>
                                </div>
                            </div>
                        @elseif($product->hasPotentialStockOut())
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content" style="padding-top: 22px">
                                        <span class="info-box-text">Potential Stock Out</span>
                                        <span class="info-box-number">{{ number_format($product->stock_quantity) }} <small>{{ str_plural('unit', $product->stock_quantity) }}</small></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!$product->hasExcessStock())
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box bg-blue">
                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="info-box-content" style="padding-top: 22px">
                                        <span class="info-box-text">Required Stock</span>
                                        <span class="info-box-number">{{ number_format($product->requiredStock()) }} <small>{{ str_plural('unit', $product->stock_quantity) }}</small></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<product-forecast :product="{{$product}}"></product-forecast>
@endsection @push('js-after')
<script>
    $(document).ready(function () {
        var chartData = {
            labels: [{!!chartify($report['forecast']['labels']) !!}],
            datasets: [{
                    label: 'Forecast',
                    borderColor: '#f39c12',
                    pointRadius: 2,
                    borderWidth: 1,
                    data: [{!!chartify($report['forecast']['data']) !!}],
                },
                {
                    label: 'Adjusted Forecast',
                    borderColor: '#f56954',
                    pointRadius: 2,
                    borderWidth: 1,
                    data: [{!!chartify($report['forecast']['adjusted']) !!}],
                },
                {
                    label: 'Quantity',
                    borderColor: '#00c0ef',
                    pointRadius: 2,
                    borderWidth: 1,
                    data: [{!!chartify($report['quantity']['data']) !!}],
                },
            ]
        }

        var chartOptions = {
            maintainAspectRatio: false,
            legend: {
                display: true
            }
        }

        var chart = new Chart('yearlyRecap', {
            type: 'line',
            data: chartData,
            options: chartOptions
        });
    });
</script>
@endpush