<div class="btn-group">
    <button type="button" class="btn btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li>
            <a href="{{ action('RolesController@show', $role->id) }}"><i class="fa fa-eye"></i>View</a>
        </li>
        <li>
            <a href="{{ action('RolesController@edit', $role->id) }}"><i class="fa fa-pencil"></i>Edit</a>
        </li>
    </ul>
</div>
