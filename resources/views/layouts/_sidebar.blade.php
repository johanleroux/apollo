<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>John Doe [Manager]</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">RESOURCES</li>
            <li><a href="{{ action('CustomersController@index') }}"><i class="fa fa-users"></i> <span>Customers</span></a></li>
            <li><a href="{{ action('ProductsController@index') }}"><i class="fa fa-shopping-cart"></i> <span>Products</span></a></li>
            <li><a href="{{ action('SuppliersController@index') }}"><i class="fa fa-building"></i> <span>Suppliers</span></a></li>
            <li class="header">TRANSACTIONS</li>
            <li><a href="{{ action('PurchasesController@index') }}"><i class="fa fa-credit-card"></i><span>Purchases</span></a></li>
            <li><a href="{{ action('SalesController@index') }}"><i class="fa fa-money"></i><span>Sales</span></a></li>
            <li class="header">MANAGEMENT</li>
            <li><a href="{{ action('CompaniesController@edit') }}"><i class="fa fa-info-circle"></i><span>Company Info</span></a></li>
            <li><a href="#"><i class="fa fa-user-circle-o"></i><span>Users</span></a></li>
        </ul>
    </section>
</aside>
