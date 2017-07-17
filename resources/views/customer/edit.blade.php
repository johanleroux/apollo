@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('customer_edit', $customer) !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Customer</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->modelForm($customer, 'PUT', action('CustomersController@update', $customer))->open() }}

                    @include('customer._form')

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
@endsection
