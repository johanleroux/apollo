<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    {{ auth()->user()->name }}<br>
                    <small>[{{ title_case(auth()->user()->role->name) }}]</small><br/>
                </p>
            </div>
        </div>
        <ul class="sidebar-menu">
            @if(auth()->user()->isA('sales') || auth()->user()->isA('manager') || auth()->user()->isA('admin'))
                <li class="header">RESOURCES</li>
                <li><a href="{{ action('CustomersController@index') }}"><i class="fa fa-users"></i> <span>Customers</span></a></li>
                <li><a href="{{ action('ProductsController@index') }}"><i class="fa fa-shopping-cart"></i> <span>Products</span></a></li>
                <li><a href="{{ action('SuppliersController@index') }}"><i class="fa fa-building"></i> <span>Suppliers</span></a></li>
            @endif
            @if(auth()->user()->isA('sales') || auth()->user()->isA('manager') || auth()->user()->isA('admin'))
                <li class="header">TRANSACTIONS</li>
                <li><a href="{{ action('PurchasesController@index') }}"><i class="fa fa-credit-card"></i><span>Purchases</span></a></li>
                <li><a href="{{ action('PurchasesController@index', ['open' => 1]) }}"><i class="fa fa-credit-card"></i><span>Open Purchases</span></a></li>
                <li><a href="{{ action('SalesController@index') }}"><i class="fa fa-money"></i><span>Sales</span></a></li>
            @endif
            @if(auth()->user()->isA('admin'))
                <li class="header">MANAGEMENT</li>
                <li><a href="{{ action('CompaniesController@edit') }}"><i class="fa fa-info-circle"></i><span>Company Info</span></a></li>
                <li><a href="{{ action('UsersController@index') }}"><i class="fa fa-user-circle-o"></i><span>Manage Users</span></a></li>
                <li><a href="{{ action('RolesController@index') }}"><i class="fa fa-link"></i><span>Roles &amp; Permissions</span></a></li>
            @endif
        </ul>
    </section>
</aside>
