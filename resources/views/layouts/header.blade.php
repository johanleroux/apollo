<header class="main-header">
  <a href="{{ url('/') }}" class="logo">
    <span class="logo-mini"><b>P</b></span>
    <span class="logo-lg"><b>Paradox</b></span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <div class="pull-left"><img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"></div>
                    <h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li>
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-red"></i> 5 products have low stock
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">John Doe</span>
          </a>
          <ul class="dropdown-menu" style="width: 50%">
            <li>
              <a href="#"><i class="fa fa-gears"></i>Settings</a>
              <a href="{{ route('login') }}"><i class="fa fa-lock"></i>Sign Out</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
