@extends('layouts.app')

@section('page-title', 'Products')
@section('body-class', 'sidebar-mini skin-black-light fixed')

@section('content')
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


  </div>
@endsection

@push('js')
@endpush
