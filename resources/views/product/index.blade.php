@extends('layouts.backend')
    @section('content-header')
    {!! Breadcrumbs::render('product') !!}

    <div class="btn-group pull-right">
        @if(auth()->user()->isAn('admin') || auth()->user()->can('create-product'))
            <a class="btn btn-sm" href="{{ action('ProductsController@create') }}"><i class="fa fa-plus"></i> Create</a>
        @endif
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
