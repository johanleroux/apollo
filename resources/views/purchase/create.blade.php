@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('purchase_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-bpurchase">
            <h3 class="box-title">Create Purchase</h3>
        </div>
        <div class="box-body">
            {{ html()->form('POST', action('PurchasesController@store'))->open() }}
            <invoice :suppliers="{{ $suppliers }}"></invoice>
            {{-- @include('purchase._form')

            <input class="btn btn-primary pull-right" type="submit" value="Save Changes"> --}}
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@endsection
