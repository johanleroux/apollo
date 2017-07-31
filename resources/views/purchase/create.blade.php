@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('purchase_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Create Purchase</h3>
        </div>
        <div class="box-body">
            <invoice :suppliers="{{ $suppliers }}"></invoice>
        </div>
    </div>
</div>
@endsection
