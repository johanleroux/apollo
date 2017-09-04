@extends('layouts.backend')

@section('content-header')
  {!! Breadcrumbs::render('supplier') !!}

  <div class="btn-group pull-right">
      @if(auth()->user()->isAn('admin') || auth()->user()->can('create-supplier'))
          <a href="{{ action('SuppliersController@create') }}" class="btn btn-sm"> Create <i class="fa fa-plus"></i></a>
      @endif
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
  <script type="text/javascript">
  $(document).ready(function () {
    {{ $dataTable->generateScripts() }}
  });
  </script>
@endpush
