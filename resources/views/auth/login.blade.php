@extends('layouts.app')

@section('page-title', 'Login')
@section('body-class', 'login-page')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}"><b>Paradox</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      {{ html()->form('post', '/login')->open() }}

      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        {{ html()->email('email')->class('form-control')->placeholder('Email')->attribute('required autofocus') }}
        {{ html()->span()->class('glyphicon glyphicon-envelope form-control-feedback') }}
      </div>

      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        {{ html()->password('password')->class('form-control')->placeholder('Password')->attribute('required') }}
        {{ html()->span()->class('glyphicon glyphicon-lock form-control-feedback') }}
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              {{ html()->checkbox('remember_me') }} Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          {{ html()->button('Sign In', 'submit')->class('btn btn-primary btn-block btn-flat') }}
        </div>
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
      {{ html()->form()->close() }}
      <a href="#">I forgot my password</a><br>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
@endsection

@push('js')
  <!-- iCheck -->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
@endpush
