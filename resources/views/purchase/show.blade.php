@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('purchase_show', $purchase) !!}

    @if(!$purchase->processed_at)
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="#" data-toggle="modal" data-target="#purchaseProcess"><i class="fa fa-pencil"></i> Process Purchase</a></li>
            </ul>
        </div>
    @endif
@endsection
@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> {{ $company->name }}
                <small class="pull-right">Date: {{ $purchase->created_at->toDateString() }}</small>
              </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            From:
            <address>
                {!! $purchase->supplier->detailsPrint !!}
            </address>
        </div>
        <div class="col-sm-6 invoice-col text-right">
            <b>Purchase ID:</b> #{{ $purchase->id }}
            <br>
            <b>Process Date:</b> {{ $purchase->processed_at ?  $purchase->processed_at->toDateTimeString() : 'Not Yet Processed' }}
            <br>
            @if($purchase->processed_at)
                <b>External Invoice #:</b> {{ $purchase->ext_invoice }}
            @endif
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
                        <td class="text-right"><b>{{ price_format($purchase->total) }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@if(!$purchase->processed_at)
<purchase-process :purchase="{{ $purchase->id }}"></purchase-process>
@endif
@endsection
