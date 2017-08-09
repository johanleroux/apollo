@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('product_show', $product) !!}

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{ action('ProductsController@edit', $product) }}"><i class="fa fa-pencil"></i> Edit</a></li>
            <li><a href="#" onclick="$('#product_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
            {{ html()->form('DELETE', action('ProductsController@destroy', $product))->id('product_destroy')->open() }}
            {{ html()->form()->close() }}
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li><a href="#account" data-toggle="tab" aria-expanded="false">Account</a></li>
                    <li><a href="#summary" data-toggle="tab" aria-expanded="false">Summary</a></li>
                    <li class="active"><a href="#report" data-toggle="tab" aria-expanded="false">Report</a></li>
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
                        <p>There is current <b>{{ $report['stock'] }} {{ str_plural('unit', $report['stock']) }}</b> of product in stock</p>
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
                              <p class="text-center"><strong>Monthly Sales: {{ $report['recap']['startDate'] }} - {{ $report['recap']['endDate'] }}</strong></p>
                              <div class="chart">
                                  <canvas id="yearlyRecap" style="height:300px"></canvas>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-after')
    <script>
    $(document).ready(function () {
        var chartData = {
            labels  : [{!! chartify($report['recap']['labels']) !!}],
            datasets: [
                {
                    label:       'Monthly Sales',
                    fillColor:   '#ecf0f5',
                    borderColor: '#00c0ef',
                    pointRadius: 2,
                    borderWidth: 1,
                    data:        [{!! chartify($report['recap']['data']) !!}],
                }
            ]
        }

        var chartOptions = {
            maintainAspectRatio: false,
            legend: {
                display: false
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
