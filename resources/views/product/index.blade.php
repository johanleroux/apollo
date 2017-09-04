@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('product') !!}

    <div class="btn-group pull-right">
    </div>

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            @if(auth()->user()->isAn('admin') || auth()->user()->can('create-product'))
                <li><a href="{{ action('ProductsController@create') }}"><i class="fa fa-plus"></i> Create</a></li>
            @endif
            <li class="divider"></li>
            <li><a target="_blank" href="{{ action('CsvController@recap') }}"><i class="fa fa-external-link"></i> Recap</a></li>
            <li><a target="_blank" href="{{ action('CsvController@sales') }}"><i class="fa fa-external-link"></i> Sales</a></li>
            <li><a target="_blank" href="{{ action('CsvController@purchases') }}"><i class="fa fa-external-link"></i> Purchases</a></li>
            <li><a target="_blank" href="{{ action('CsvController@open_purchases') }}"><i class="fa fa-external-link"></i> Open Purchases</a></li>
        </ul>
    </div>    
@endsection

@section('content')
    @if(!request()->has('supplier_id'))
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Top By Quantity</span>
                        <span class="info-box-number">
                            <a class="text-black" href="{{ action('ProductsController@show', $stats['quantity']['product']) }}">{{ $stats['quantity']['product']->sku }}</a><br>
                            <small>{{ $stats['quantity']['quantity'] }} units</small>
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
                            <a class="text-black" href="{{ action('ProductsController@show', $stats['value']['product']) }}">{{ $stats['value']['product']->sku }}</a><br>
                            <small>{{ price_format($stats['value']['value']) }}</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
