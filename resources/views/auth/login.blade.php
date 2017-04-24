@section('page-title', 'Login')
@section('body-class', 'login-page')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>@yield('page-title', 'Dashboard') | Paradox</title>

  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

  <script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
  ]) !!};
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition @yield('body-class', '')">
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

  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
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
</body>
</html>
