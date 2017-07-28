@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('purchase_edit', $purchase) !!}

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{ action('PurchasesController@show', $purchase) }}"><i class="fa fa-eye"></i> View</a></li>
            <li><a href="#" onclick="$('#purchase_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
            {{ html()->form('DELETE', action('PurchasesController@destroy', $purchase))->id('purchase_destroy')->open() }}
            {{ html()->form()->close() }}
        </ul>
    </div>
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-bpurchase">
            <h3 class="box-title">Edit {{ $purchase->name }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->modelForm($purchase, 'PUT', action('PurchasesController@update', $purchase))->open() }}

                    @include('purchase._form')

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
@endsection
