@extends('layouts.backend')

@section('content-header')
  {!! Breadcrumbs::render('purchase') !!}

  <div class="btn-group pull-right">
    <a href="{{ action('PurchasesController@create') }}" class="btn btn-sm"> Create <i class="fa fa-plus"></i></a>
  </div>
@endsection

@section('content')
  <div class="box box-default">
    @if(request()->has('supplier_id'))
      <div class="box-header with-border">
        @php 
          $supplier = \App\Models\Supplier::find(request()->supplier_id);
        @endphp
        <h3 class="box-title">Supplier - <a href="{{ action('SuppliersController@show', $supplier) }}">{{ $supplier->name}}</a></h3>
      </div>
    @elseif(request()->has('product_id'))
      <div class="box-header with-border">
        @php 
          $product = \App\Models\Product::find(request()->product_id);
        @endphp
        <h3 class="box-title">Product - <a href="{{ action('ProductsController@show', $product) }}">{{ $product->sku}}</a></h3>
      </div>
    @endif
    <div class="box-body ">
      {!! $dataTable->table(['class' => 'table table-striped table-hover table-responsive', 'width' => '100%']) !!}
    </div>
  </div>
@endsection

@push('js-after')
  <script type="text/javascript">
  $(document).ready(function () {
    {{ $dataTable->generateScripts() }}
  });
  </script>
@endpush
