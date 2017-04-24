@extends('layouts.app')

@section('page-title', 'Index')
@section('body-class', 'index-page')

@section('content')
<body class="sidebar-mini skin-black-light fixed">
  <div class="wrapper">
    <header class="main-header">
      <a href="index.html" class="logo">
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
                        <div class="pull-left"><img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"></div>
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
                <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">John Doe</span>
              </a>
              <ul class="dropdown-menu" style="width: 50%">
                <li>
                  <a href="#"><i class="fa fa-gears"></i>Settings</a>
                  <a href="./login.html"><i class="fa fa-lock"></i>Sign Out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>John Doe [Manager]</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li><a href="./products.html"><i class="fa fa-link"></i> <span>Product</span></a></li>
          <li><a href="#"><i class="fa fa-link"></i> <span>Orders</span></a></li>
        </ul>
      </section>
    </aside>

    <div class="content-wrapper">
      <section class="content">
          <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Stock Levels</span>
          <span class="info-box-number">78<small>%</small></span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Stock Value</span>
          <span class="info-box-number">R1,241,410.00</span>
        </div>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Est. Margin</span>
          <span class="info-box-number">R760,000.00</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-exclamation"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Order Urgency</span>
          <span class="info-box-number">Low</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Yearly Recap Report</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center"><strong>Stock Levels: 1 Feb, 2016 - 31 Jan, 2017</strong></p>
              <div class="chart">
                <canvas id="salesChart" style="height: 180px;"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-4 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                <h5 class="description-header">R13,210,532.35</h5>
                <span class="description-text">TOTAL REVENUE</span>
              </div>
            </div>
            <div class="col-sm-4 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                <h5 class="description-header">R8,390,456.90</h5>
                <span class="description-text">TOTAL COST</span>
              </div>
            </div>
            <div class="col-sm-4 col-xs-6">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                <h5 class="description-header">R4,820,075.45</h5>
                <span class="description-text">TOTAL PROFIT</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      </section>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">Template by <a href="http://almsaeedstudio.com/">Almsaeed Studio</a></div>
      <strong>Paradox</strong> &copy; 2017
    </footer>
  </div>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="plugins/fastclick/fastclick.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/chartjs/Chart.min.js"></script>
  <script src="../../plugins/bootstrap-slider/bootstrap-slider.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="js/demo.js"></script>
</body>

@endsection



@push('js')
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endpush