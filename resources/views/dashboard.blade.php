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
    <div class="clearfix visible-sm-block"></div>
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
              <p class="text-center"><strong>Stock Levels: {{ $report->yearlyRecap()['startDate'] }} - {{ $report->yearlyRecap()['endDate'] }}</strong></p>
              <div class="chart">
                  <canvas id="areaChart" style="height:300px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js-after')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
    <script>
      $(function () {
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChart       = new Chart(areaChartCanvas)

        var areaChartData = {
          labels  : [{!! $report->yearlyRecap()['labels'] !!}],
          datasets: [
            {
              label:            'Monthly Sales',
              fillColor:        '#ecf0f5',
              strokeColor:      '#00c0ef',
              pointColor:       '#00c0ef',
              pointStrokeColor: '#00c0ef',
              data:             [{!! $report->yearlyRecap()['data'] !!}]
            }
          ]
        }

        var areaChartOptions = {
          showScale:           true,
          scaleShowGridLines:  false,
          pointDot:            false,
          maintainAspectRatio: true,
          responsive:          true,
          maintainAspectRatio: false,
        }

        areaChart.Line(areaChartData, areaChartOptions)
      })
    </script>
@endpush
