@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('role_edit', $role) !!}

    <div class="btn-group pull-right">
        <a class="btn btn-sm" onclick="$('#role_destroy').submit();"><i class="fa fa-trash"></i> Delete</a>
        {{ html()->form('DELETE', action('RolesController@destroy', $role))->id('role_destroy')->open() }}
        {{ html()->form()->close() }}
    </div>
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit {{ title_case($role->name) }} Permissions</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->modelForm($role, 'PUT', action('RolesController@update', $role))->open() }}

                    <div class="row">
                        @foreach($abilities as $abilitesList)
                        <div class="col-md-3">
                            @foreach($abilitesList as $ability)
                                {{ html()->checkbox("ability[" . $ability["name"] . "]", $roleAbilities->contains('name', $ability["name"])) }}
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
                    {{ html()->closeModelForm() }}
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
