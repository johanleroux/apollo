@extends('layouts.app')

@section('page-title', 'Forget Password')
@section('body-class', 'forget_password-page')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="index.html"><b>Paradox</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset your password</p>

    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
        <!-- /.col -->
        <div class="row">
          <div class="col-xs-4 pull-right">
            <a href="./modify_password.html" type="submit" class="btn btn-primary btn-block btn-flat">Reset</a>
          </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>


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
