<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login | Apollo</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        window.Laravel = {
            !!json_encode([
                'url' => URL('/'),
                'csrfToken' => csrf_token()
            ]) !!
        };
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="hold-transition login-page">
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
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @include('errors._helpblock', ['field' => 'email'])
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                {{ html()->password('password')->class('form-control')->placeholder('Password')->attribute('required') }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @include('errors._helpblock', ['field' => 'password'])
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
            </div>
            {{ html()->form()->close() }}
            <a href="{{ url('forget_password') }}">I forgot my password</a>
            <br>
        </div>
        <!-- /.login-box-body -->
    </div>

    <script data-turbolinks-eval="false" src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>
