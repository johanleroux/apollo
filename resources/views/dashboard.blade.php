@extends('layouts.backend')
@section('page-title', 'Dashboard | Apollo')
@section('content-header')
  {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Overall Stock</span>
          <span class="info-box-number">{{ $report['stockQuantity'] }} <small>units</small></span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Stock Value</span>
          <span class="info-box-number">{{ price_format($report['stockValue'], true) }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Est. Margin</span>
          <span class="info-box-number">{{ price_format($report['estimateMargin'], true) }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">TOP PRODUCT</span>
                <span class="info-box-number">
                    <a class="text-black" href="{{ action('ProductsController@show', $report['quantity']['product']) }}">{{ $report['quantity']['product']->sku }}</a><br>
                    <small>{{ $report['quantity']['quantity'] }} units</small>
                </span>
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
  <div class="row">
      <div class="col-md-3">
          <a class="btn btn-info btn-flat form-control" target="_blank" href="{{ action('CsvController@recap') }}">
              <i class="fa fa-external-link"></i> Recap</a>
          </a>
      </div>
      <div class="col-md-3">
          <a class="btn btn-info btn-flat form-control" target="_blank" href="{{ action('CsvController@sales') }}">
              <i class="fa fa-external-link"></i> Sales</a>
          </a>
      </div>
      <div class="col-md-3">
          <a class="btn btn-info btn-flat form-control" target="_blank" href="{{ action('CsvController@purchases') }}">
              <i class="fa fa-external-link"></i> Purchases</a>
          </a>
      </div>
      <div class="col-md-3">
          <a class="btn btn-info btn-flat form-control" target="_blank" href="{{ action('CsvController@open_purchases') }}">
              <i class="fa fa-external-link"></i> Open Purchases</a>
          </a>
      </div>
  </div>
@endsection
@push('js-after')
    <script>
    $(function () {
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
    })
    </script>
@endpush
