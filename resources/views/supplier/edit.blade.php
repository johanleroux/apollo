@extends('layouts.app')

@section('page-title', 'Suppliers')
@section('body-class', 'sidebar-mini skin-black-light fixed')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Supplier [{{ $supplier->id}}]</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              {{ html()->modelForm($supplier, 'PATCH', action('SuppliersController@update', $supplier))->open() }}

              <div class="form-group has-feedback ">
                <label for="name">Name:</label>
                {{ html()->text('name')->id('name')->class('form-control')->placeholder('Name') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="email">Email:</label>
                {{ html()->email('email')->id('email')->class('form-control')->placeholder('Email') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="telephone">Telephone:</label>
                {{ html()->text('telephone')->id('telephone')->class('form-control')->placeholder('Telephone') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="address">Address:</label>
                {{ html()->text('address')->id('address')->class('form-control')->placeholder('Address') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="address_2">Secondary Address:</label>
                {{ html()->text('address_2')->id('address_2')->class('form-control')->placeholder('Secondary Address') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="city">City:</label>
                {{ html()->text('city')->id('city')->class('form-control')->placeholder('City') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="province">Province:</label>
                {{ html()->text('province')->id('province')->class('form-control')->placeholder('Province') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback ">
                <label for="country">Country:</label>
                {{ html()->text('country')->id('country')->class('form-control')->placeholder('Country') }}
                <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
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
