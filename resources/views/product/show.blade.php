@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('product_show', $product) !!}

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{ action('ProductsController@edit', $product) }}"><i class="fa fa-pencil"></i> Edit</a></li>
            <li><a href="#" onclick="$('#product_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
            {{ html()->form('DELETE', action('ProductsController@destroy', $product))->id('product_destroy')->open() }}
            {{ html()->form()->close() }}
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#account" data-toggle="tab" aria-expanded="false">Account</a></li>
                    <li class="pull-left header"><i class="fa fa-shopping-cart"></i> {{ $product->sku }}</li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="account">
                        {{ html()->modelForm($product) }}

                        @include('product._form')

                        {{ html()->closeModelForm() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
