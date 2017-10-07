@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('purchase_show', $purchase) !!}

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            @if(!$purchase->processed_at)
                <li><a href="#" data-toggle="modal" data-target="#purchaseProcess"><i class="fa fa-pencil"></i> Process Purchase</a></li>
            @else
                <li><a href="#" data-toggle="modal" data-target="#externalInvoice"><i class="fa fa-pencil"></i> External Invoice</a></li>
            @endif
        </ul>
    </div>
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
                <b>External Invoice #:</b> {{ $purchase->ext_invoice_number }}
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
                    @foreach($purchaseItems as $item)
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

<div class="modal fade" id="externalInvoice" tabindex="-1" role="dialog" aria-labelledby="externalInvoiceLbl">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="externalInvoiceLbl">External Invoice</h4>
            </div>
            <div class="modal-body">
                @if($purchase->ext_invoice_image)
                    <a href="{{ asset('storage/' . $purchase->ext_invoice_image) }}">
                        <img class="img-responsive" src="{{ asset('storage/' . $purchase->ext_invoice_image) }}" alt="">
                    </a>
                @else
                    <p>No External Invoice Image Available...</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
