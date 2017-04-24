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
      <li><a href="{{ action('ProductsController@index') }}"><i class="fa fa-link"></i> <span>Product</span></a></li>
      <li><a href="#"><i class="fa fa-link"></i> <span>Orders</span></a></li>
    </ul>
  </section>
</aside>
