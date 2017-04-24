@extends('layouts.app')

@section('page-title', 'Suppliers')
@section('body-class', 'sidebar-mini skin-black-light fixed')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Suppliers</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    <a href="{{ action('SuppliersController@create') }}" class="btn btn-info" style="margin-left:15px;">Create</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($suppliers as $supplier)
                    <tr>
                      <td>{{ $supplier->id }}</td>
                      <td><a href="#">{{ $supplier->name }}</a></td>
                      <td>{{ $supplier->email }}</td>
                      <td style="width: 220px">
                        <div class="btn-group">
                          <a href="{{ action('SuppliersController@edit', $supplier) }}" class="btn btn-xs btn-flat btn-info">Edit</a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan"5">Sorry, but there is no suppliers on the system.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="box-footer clearfix text-right">
              {{ $suppliers->links() }}
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
