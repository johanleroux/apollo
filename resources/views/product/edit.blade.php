@extends('layouts.app')

@section('page-title', 'Products')
@section('body-class', 'sidebar-mini skin-black-light fixed')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product [{{ $product->id}}]</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              {{ html()->modelForm($product, 'PATCH', action('ProductsController@update', $product))->open() }}
              <div class="form-group has-feedback ">
                <label for="description">Description:</label>
                {{ html()->text('description')->id('description')->class('form-control')->placeholder('Description') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="price">Stock Price:</label>
                {{ html()->text('price')->id('price')->class('form-control')->placeholder('Price') }}
                <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  @if($errors->count() > 0)
                    <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
              <input class="btn btn-primary" type="submit" value="Save Changes">
              {{ html()->closeModelForm() }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
