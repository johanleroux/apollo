@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('sale_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Create Sale</h3>
        </div>
        <div class="box-body">
            <sale :customers="{{ $customers }}" :products="{{ $products }}"></sale>
        </div>
    </div>
</div>
@endsection
