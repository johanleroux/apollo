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
        <div class="col-sm-6 invoice-col text-right" style="float:right">
            <b>Sale ID:</b> #{{ $sale->id }} <br>
            <address>{!! $company->detailsPrint !!}</address>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right" style="width: 100px">Price</th>
                        <th class="text-right" style="width: 100px">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleItems as $item)
                        <tr>
                            <td>{{ $item->product->sku }}</td>
                            <td>{{ $item->product->description }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-right">{{ price_format($item->price) }}</td>
                            <td class="text-right">{{ price_format($item->total) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>VAT</b> (14%)</td>
                        <td class="text-right"><b>{{ price_format($sale->vat) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Sub Total</b></td>
                        <td class="text-right"><b>{{ price_format($sale->subtotal) }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Total</b></td>
                        <td class="text-right"><b>{{ price_format($sale->total) }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
