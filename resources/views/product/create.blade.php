@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('product_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create Product</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->form('POST', action('ProductsController@store'))->open() }}

                    @include('product._form')

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
