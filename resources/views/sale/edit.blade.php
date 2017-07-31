@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('sale_edit', $sale) !!}

    <div class="btn-group pull-right">
        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="{{ action('SalesController@show', $sale) }}"><i class="fa fa-eye"></i> View</a></li>
            <li><a href="#" onclick="$('#sale_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
            {{ html()->form('DELETE', action('SalesController@destroy', $sale))->id('sale_destroy')->open() }}
            {{ html()->form()->close() }}
        </ul>
    </div>
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-bsale">
            <h3 class="box-title">Edit {{ $sale->name }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->modelForm($sale, 'PUT', action('SalesController@update', $sale))->open() }}

                    @include('sale._form')

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
@endsection
