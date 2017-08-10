<div class="btn-group">
    <button type="button" class="btn btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li>
            <a href="{{ action('PurchasesController@show', $purchase->id) }}"><i class="fa fa-eye"></i>View</a>
        </li>
        @if(!$purchase->processed_at)
        <li>
            <a href="{{ action('PurchasesController@edit', $purchase->id) }}"><i class="fa fa-pencil"></i>Edit</a>
        </li>
        @endif
    </ul>
</div>
