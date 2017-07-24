@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('order_show', $order) !!}

<div class="btn-group pull-right">
    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li><a href="#"><i class="fa fa-pencil"></i> Action</a></li>
    </ul>
</div>
@endsection
@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> AdminLTE, Inc.
                <small class="pull-right">Date: {{ $order->created_at->toDateString() }}</small>
              </h2>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            From
            <address>
                <strong>{{ $supplier->name }}</strong><br>
                {{ $supplier->address }}, {{ $supplier->address_2 }}<br>
                {{ $supplier->city }}, {{ $supplier->province }}<br>
                {{ $supplier->country }}<br>
                Phone: {{ $supplier->telephone }}<br>
                Email: {{ $supplier->email }}
              </address>
        </div>
        <div class="col-sm-6 invoice-col text-right">
            <b>Order ID:</b> #{{ $order->id }}
            <br>
            <b>Process Date:</b> {{ $order->process_date->toDateTimeString() }}
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
                        <td class="text-right"><b>{{ price_format($order->total) }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
