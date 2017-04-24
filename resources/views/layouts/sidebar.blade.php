<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>John Doe [Manager]</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li><a href="{{ action('CustomersController@index') }}"><i class="fa fa-link"></i> <span>Customers</span></a></li>
      <li><a href="{{ action('SuppliersController@index') }}"><i class="fa fa-link"></i> <span>Suppliers</span></a></li>
      <li><a href="{{ action('ProductsController@index') }}"><i class="fa fa-link"></i> <span>Products</span></a></li>
    </ul>
  </section>
</aside>
