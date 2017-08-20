@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('product_show', $product) !!}

    @if(auth()->user()->isA('manager') || auth()->user()->isA('admin'))
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="{{ action('ProductsController@edit', $product) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                <li><a href="#" onclick="$('#product_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
                {{ html()->form('DELETE', action('ProductsController@destroy', $product))->id('product_destroy')->open() }}
                {{ html()->form()->close() }}
                <li role="presentation" class="divider"></li>
                {{-- <li><a target="_blank" href="{{ action('CsvController@forecast', $product) }}"><i class="fa fa-external-link"></i> Forecast</a></li> --}}
                <li><a target="_blank" href="{{ action('CsvController@recap', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Recap</a></li>
                <li><a target="_blank" href="{{ action('CsvController@sales', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Sales</a></li>
                <li><a target="_blank" href="{{ action('CsvController@purchases', ['product_id' => $product]) }}"><i class="fa fa-external-link"></i> Purchases</a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="#" data-toggle="modal" data-target="#manualForecast"><i class="fa fa-pencil"></i> Manual Forecast</a></li>
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#account" data-toggle="tab" aria-expanded="false">Account</a></li>
                    <li><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
                    <li class="active"><a href="#report" data-toggle="tab" aria-expanded="false">Report</a></li>
                    <li><a href="{{ action('SuppliersController@show', $product->supplier) }}">Supplier <i class="fa fa-external-link"></i></a></li>
                    <li class="pull-left header"><i class="fa fa-shopping-cart"></i> {{ $product->sku }}</li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="account">
                        {{ html()->modelForm($product) }}

                        @include('product._form')

                        {{ html()->closeModelForm() }}
                    </div>
                    <div class="tab-pane" id="summary">
                        <h3>Stock Levels</h3>
                        <p>There is current <b>{{ $product->stock_quantity }} {{ str_plural('unit', $product->stock_quantity) }}</b> of product in stock</p>
                        <hr>
                        @if($report['sales']->count() > 0)
                            <h3>Last {{ $report['sales']->count() }} Sales</h3>
                            <ul class="list-unstyled">
                            @foreach($report['sales'] as $sale)
                                <li><a href="{{ action('SalesController@show', $sale->sale_id) }}">#{{ $sale->sale_id }}</a> - {{ price_format($sale->total) }} - {{ $sale->quantity }} {{ str_plural('unit', $sale->quantity) }} to <a href="{{ action('CustomersController@show', $sale->sale->customer) }}">{{ $sale->sale->customer->name }}</a> at {{ price_format($sale->price) }}/unit</li>
                            @endforeach
                            </ul>
                        @else
                            <p>There has been no sales for this product.</p>
                        @endif
                    </div>
                    <div class="tab-pane active" id="report">
                          <div class="row">
                            <div class="col-md-12">
                              <p class="text-center"><strong>Monthly Sales: {{ $report['quantity']['startDate'] }} - {{ $report['quantity']['endDate'] }}</strong></p>
                              <div class="chart">
                                  <canvas id="yearlyRecap" style="height:300px"></canvas>
                              </div>
                              <small>Last Forecast: {{ $product->last_forecast ?? 'Never' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <product-forecast :product="{{$product}}"></product-forecast>
@endsection

@push('js-after')
    <script>
    $(document).ready(function () {
        var chartData = {
            labels  : [{!! chartify($report['forecast']['labels']) !!}],
            datasets: [
                {
                    label:       'Forecast',
                    borderColor: '#f39c12',
                    pointRadius: 2,
                    borderWidth: 1,
                    data:        [{!! chartify($report['forecast']['data']) !!}],
                },
                {
                    label:       'Adjusted Forecast',
                    borderColor: '#f56954',
                    pointRadius: 2,
                    borderWidth: 1,
                    data:        [{!! chartify($report['forecast']['adjusted']) !!}],
                },
                {
                    label:       'Quantity',
                    borderColor: '#00c0ef',
                    pointRadius: 2,
                    borderWidth: 1,
                    data:        [{!! chartify($report['quantity']['data']) !!}],
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
            type:    'line',
            data:    chartData,
            options: chartOptions
        });
    });
    </script>
@endpush
