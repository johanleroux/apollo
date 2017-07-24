<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\Datatables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('actions', function (Order $order) {
                return view('order.datatable._actions', compact('order'));
            })
            ->editColumn('supplier', function (Order $order) {
                return $order->supplier->name;
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Order::query()->with(['supplier', 'items']);

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'dom'        => 'Bfrtip',
                        'pageLength' => '25',
                        'order'      => [[0, 'desc']],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'           => ['title' => 'Order #'],
            'supplier'     => ['name' => 'supplier.name', 'orderable' => false, 'searchable' => true],
            'created_at'   => ['title' => 'Created Date'],
            'process_date' => ['title' => 'Process Date'],
            'processed_at' => ['title' => 'Processed At'],
            'actions'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders_' . time();
    }
}
