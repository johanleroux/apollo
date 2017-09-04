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
            <purchase :suppliers="{{ $suppliers }}" :sup="{{ request()->query('supplier_id') ?: 'null'}}"></purchase>
        </div>
    </div>
</div>
@endsection
