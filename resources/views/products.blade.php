@extends('layouts.app')

@section('page-title', 'Products')
@section('body-class', 'products-page')

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
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Manage Product</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Stock (%)</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                                              <tr>
                  <td>688</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">67%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>361</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">7%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>708</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">10%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>205</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-orange">41%</span></td>
                  <td><span class="badge bg-orange">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>159</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">52%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>138</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">21%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>989</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">54%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>772</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">68%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>413</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-orange">37%</span></td>
                  <td><span class="badge bg-orange">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>979</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-green">79%</span></td>
                  <td><span class="badge bg-green">High</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>545</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">59%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>778</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">66%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>866</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">2%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>321</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">54%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>988</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-orange">37%</span></td>
                  <td><span class="badge bg-orange">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>175</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">16%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>515</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-orange">39%</span></td>
                  <td><span class="badge bg-orange">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>347</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">9%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>870</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">22%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>319</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-green">97%</span></td>
                  <td><span class="badge bg-green">High</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>284</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">53%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>688</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">55%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>623</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-green">92%</span></td>
                  <td><span class="badge bg-green">High</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>807</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-blue">60%</span></td>
                  <td><span class="badge bg-blue">Medium</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                                              <tr>
                  <td>169</td>
                  <td><a href="./product.html">Lorem ipsum dolor sit amet.</a></td>
                  <td><span class="badge bg-red">6%</span></td>
                  <td><span class="badge bg-red">Low</span></td>
                  <td style="width: 220px">
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-flat btn-success" data-toggle="modal" data-target="#sellModal">Sell</button>
                      <a href="./product_edit.html" class="btn btn-xs btn-flat btn-info">Edit</a>
                      <button type="button" class="btn btn-xs btn-flat btn-warning" data-toggle="modal" data-target="#myOrder">Order</button>
                      <button type="button" class="btn btn-xs btn-flat btn-danger" data-toggle="modal" data-target="#myModal">Set Warning</button>
                    </div>
                  </td>
                </tr>
                          </tbody>
          </table>
        </div>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-md no-margin pull-right">
            <li><a href="#">«</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">»</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Set Stock Warning Levels</h4>
        </div>
        <div class="modal-body">
          <p>
            <input type="text" class="slider form-control" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="45" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!--- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="myOrder">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Order Stock</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Supplier</label>

                  <div class="col-sm-10">
                    <select class="form-control">
                      <option>Lorem</option>
                      <option>ipsum</option>
                      <option>dolor</option>
                      <option>sit</option>
                      <option>amet</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Quantity" min="1">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Request Order</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="sellModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Sell Stock</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Client</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Client" min="1">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Quantity" min="1">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Process Sale</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
  <script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
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
