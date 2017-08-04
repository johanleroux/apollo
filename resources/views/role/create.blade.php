@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('role_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create Role</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->form('POST', action('RolesController@store'))->open() }}

                    <div class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
                        <label for="name">Name:</label>
                        {{ html()->text('name')->id('name')->class('form-control')->placeholder('Name') }}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'name'])
                    </div>

                    <label for="abilities">Abilities:</label>
                    <div class="row">
                        @foreach($abilities as $abilitesList)
                        <div class="col-md-3">
                            @foreach($abilitesList as $ability)
                                {{ html()->checkbox("ability[" . $ability["name"] . "]") }}
                                {{ html()->label($ability["name"], "ability[" . $ability["name"] . "]") }} <br>
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <h4><i class="icon fa fa-ban"></i> Validation failed!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input class="btn btn-primary pull-right" type="submit" value="Save Changes">
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-after')
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });
        });
    </script>
@endpush
