@extends('layouts.backend')

@section('content-header')
    {!! Breadcrumbs::render('customer_show', $customer) !!}

    @if(!$customer->trashed())
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="{{ action('SalesController@create', ['customer_id' => $customer->id]) }}"><i class="fa fa-money"></i> Sale</a></li>
                <li class="divider"></li>
                @if(auth()->user()->isA('manager') || auth()->user()->isA('admin'))
                    <li><a href="{{ action('CustomersController@edit', $customer) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                    <li><a href="#" onclick="$('#customer_destroy').submit();"><i class="fa fa-trash"></i> Archive</a></li>
                    {{ html()->form('DELETE', action('CustomersController@destroy', $customer))->id('customer_destroy')->open() }}
                    {{ html()->form()->close() }}
                @endif
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#account" data-toggle="tab" aria-expanded="false">Account</a></li>
                    <li><a href="{{ action('SalesController@index', ['customer_id' => $customer->id]) }}">Sales <i class="fa fa-external-link"></i></a></li>
                    <li class="pull-left header"><i class="fa fa-user"></i> {{ $customer->name }}</li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="account">
                        {{ html()->modelForm($customer) }}

                        @include('customer._form')

                        {{ html()->closeModelForm() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
