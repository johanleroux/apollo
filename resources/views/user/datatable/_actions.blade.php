<div class="btn-group">
    <button type="button" class="btn btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li><a href="{{ action('UsersController@edit', $user->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
        @if($user->trashed())
            <li><a href="#" onclick="$('#user_restore_{{ $user->id }}').submit();"><i class="fa fa-trash"></i> Restore</a></li>
            {{ html()->form('DELETE', action('UsersController@restore', $user))->id('user_restore_' . $user->id)->open() }}
            {{ html()->form()->close() }}
        @else
            <li><a href="#" onclick="$('#user_destroy_{{ $user->id }}').submit();"><i class="fa fa-trash"></i> Delete</a></li>
            {{ html()->form('DELETE', action('UsersController@destroy', $user))->id('user_destroy_' . $user->id)->open() }}
            {{ html()->form()->close() }}
        @endif
    </ul>
</div>
