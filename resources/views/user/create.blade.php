@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('user_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create User</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->form('POST', action('UsersController@store'))->open() }}

                    <div class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name:</label>
                        {{ html()->text('name')->id('name')->class('form-control')->placeholder('Name') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'name'])
                    </div>
                    <div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
                        <label for="email">Email:</label>
                        {{ html()->email('email')->id('email')->class('form-control')->placeholder('Email') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'email'])
                    </div>

                    <div class="form-group has-feedback @if ($errors->has('password')) has-error @endif">
                        <label for="password">Password:</label>
                        {{ html()->password('password')->id('password')->class('form-control')->placeholder('Password') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'password'])
                    </div>
                    <div class="form-group has-feedback @if ($errors->has('password_confirmation')) has-error @endif">
                        <label for="password_confirmation">Confirm Password:</label>
                        {{ html()->password('password_confirmation')->id('password_confirmation')->class('form-control')->placeholder('Confirm Password') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'password_confirmation'])
                    </div>

                    <div class="form-group has-feedback @if ($errors->has('role')) has-error @endif">
                        <label for="name">Role:</label>
                        {{ html()->select('role', $roles)->id('role')->class('form-control') }}
                        <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'role'])
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            @include('errors._block')
                        </div>
                    </div>

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
@endsection
