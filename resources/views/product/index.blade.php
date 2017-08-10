@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('product') !!}

    <div class="btn-group pull-right">
    </div>

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{ action('ProductsController@create') }}"><i class="fa fa-plus"></i> Create</a></li>
            <li><a target="_blank" href="{{ action('CsvController@recap') }}"><i class="fa fa-external-link"></i> Recap</a></li>
            <li><a target="_blank" href="{{ action('CsvController@sales') }}"><i class="fa fa-external-link"></i> Sales</a></li>
            <li><a target="_blank" href="{{ action('CsvController@purchases') }}"><i class="fa fa-external-link"></i> Purchases</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Top By Quantity</span>
                    <span class="info-box-number">
                        <a class="text-black" href="{{ action('ProductsController@show', $report->topProductByQuantity()->product) }}">{{ $report->topProductByQuantity()->product->sku }}</a><br>
                        <small>{{ $report->topProductByQuantity()->quantity }} units</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Top By Value</span>
                    <span class="info-box-number">
                        <a class="text-black" href="{{ action('ProductsController@show', $report->topProductByValue()->product) }}">{{ $report->topProductByValue()->product->sku }}</a><br>
                        <small>{{ price_format($report->topProductByValue()->value) }}</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body ">
            {!! $dataTable->table(['class' => 'table table-striped table-hover table-responsive', 'width' => '100%']) !!}
        </div>
    </div>
@endsection

@push('js-after')
    <script type="text/javascript">
    $(document).ready(function () {
        {{ $dataTable->generateScripts() }}
    });
</script>
@endpush
