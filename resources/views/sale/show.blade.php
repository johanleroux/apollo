@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('sale_show', $sale) !!}
@endsection
@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> {{ $company->name }}
                <small class="pull-right">Date: {{ $sale->created_at->toDateString() }}</small>
              </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            To:
            <address>{!! $sale->customer->detailsPrint !!}</address>
        </div>
        <div class="col-sm-6 invoice-col text-right">
            <b>Sale ID:</b> #{{ $sale->id }} <br>
            <address>{!! $company->detailsPrint !!}</address>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->product->sku }}</td>
                            <td>{{ $item->product->description }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-right">{{ price_format($item->price) }}</td>
                            <td class="text-right">{{ price_format($item->total) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-right"><b>{{ price_format($sale->total) }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
