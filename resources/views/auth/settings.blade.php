@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('settings') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit User Settings</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->modelForm(auth()->user(), 'PUT', action('UsersController@update', auth()->user()->id))->open() }}

                    <div class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name:</label>
                        {{ html()->text('name')->id('name')->class('form-control')->placeholder('Name') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'name'])
                    </div>

                    <div class="form-group has-feedback @if ($errors->has('current_password')) has-error @endif">
                        <label for="current_password">Current Password:</label>
                        {{ html()->password('current_password')->id('current_password')->class('form-control')->placeholder('Current Password') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'current_password'])
                    </div>
                    <div class="form-group has-feedback @if ($errors->has('new_password')) has-error @endif">
                        <label for="new_password">New Password:</label>
                        {{ html()->password('new_password')->id('new_password')->class('form-control')->placeholder('New Password') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'new_password'])
                    </div>
                    <div class="form-group has-feedback @if ($errors->has('password_confirmation')) has-error @endif">
                        <label for="password_confirmation">Confirm Password:</label>
                        {{ html()->password('password_confirmation')->id('password_confirmation')->class('form-control')->placeholder('Confirm Password') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'password_confirmation'])
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
