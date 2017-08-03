@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('role') !!}

    <div class="btn-group pull-right">
        <a href="{{ action('RolesController@create') }}" class="btn btn-sm"> Create <i class="fa fa-plus"></i></a>
    </div>
@endsection
@section('content')
    <div class="box box-default">
        <div class="box-body ">
            <table class="table">
                <thead>
                    <th class="text-center" width="30px">ID</th>
                    <th>Name</th>
                    <th class="text-center" width="75px">Actions</th>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td class="text-center" >{{ $role->id }}</td>
                            <td>{{ title_case($role->name) }}</td>
                            <td class="text-center" >
                                <div class="btn-group">
                                    <a href="{{ action('RolesController@edit', $role) }}" class="btn btn-xs btn-outline"><i class="fa fa-pencil"></i> Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No matching records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
