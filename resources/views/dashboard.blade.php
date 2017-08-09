@extends('layouts.backend')
@section('page-title', 'Dashboard | Apollo')
@section('content-header')
  {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Overall Stock</span>
          <span class="info-box-number">{{ $report->stockUnits() }} <small>units</small></span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Stock Value</span>
          <span class="info-box-number">{{ price_format($report->stockValue()) }}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Est. Margin</span>
          <span class="info-box-number">{{ price_format($report->estimateMargin()) }}</span>
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
              <p class="text-center"><strong>Monthly Sales: {{ $report->yearlyRecap()['startDate'] }} - {{ $report->yearlyRecap()['endDate'] }}</strong></p>
              <div class="chart">
                  <canvas id="yearlyRecap" style="height:300px"></canvas>
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
    $(function () {
        var chartData = {
            labels  : [{!! chartify($report->yearlyRecap()['labels']) !!}],
            datasets: [
                {
                    label:       'Monthly Sales',
                    fillColor:   '#ecf0f5',
                    borderColor: '#00c0ef',
                    pointRadius: 2,
                    borderWidth: 1,
                    data:        [{!! chartify($report->yearlyRecap()['data']) !!}],
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
