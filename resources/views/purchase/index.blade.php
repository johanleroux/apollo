@extends('layouts.backend')

@section('content-header')
  {!! Breadcrumbs::render('purchase') !!}

  <div class="btn-group pull-right">
    <a href="{{ action('PurchasesController@create') }}" class="btn btn-sm"> Create <i class="fa fa-plus"></i></a>
  </div>
@endsection

@section('content')
  <div class="box box-default">
    <div class="box-body ">
      {!! $dataTable->table(['class' => 'table table-striped table-hover table-responsive', 'width' => '100%']) !!}
    </div>
  </div>
@endsection

@push('js-after')
  {!! $dataTable->scripts() !!}
@endpush
