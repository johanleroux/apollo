<?php

namespace App\DataTables;

use App\Models\Sale;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\Engines\BaseEngine
     */
    public function dataTable(DataTables $dataTables, $query)
    {
        return $dataTables
            ->eloquent($query)
            ->addColumn('actions', function (Sale $sale) {
                return view('sale.datatable._actions', compact('sale'));
            })
            ->editColumn('customer', function (Sale $sale) {
                return $sale->customer->name;
            })
            ->addColumn('total', function (Sale $sale) {
                return price_format($sale->total);
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
        $query = Sale::query()->with(['customer', 'saleItems']);

        if (request()->customer_id) {
            $query->where('customer_id', request()->customer_id);
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
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
            'id'         => ['title' => 'Sale #'],
            'customer'   => ['name' => 'customer.name', 'orderable' => true, 'searchable' => true],
            'created_at' => ['title' => 'Created Date'],
            'total'      => ['orderable' => false, 'searchable' => false, 'class' => 'text-right'],
            'actions'    => ['class' => 'text-center']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'sales_' . time();
    }
}
