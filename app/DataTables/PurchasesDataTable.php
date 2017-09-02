<?php

namespace App\DataTables;

use App\Models\Purchase;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class PurchasesDataTable extends DataTable
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
            ->addColumn('actions', function (Purchase $purchase) {
                return view('purchase.datatable._actions', compact('purchase'));
            })
            ->editColumn('supplier', function (Purchase $purchase) {
                return $purchase->supplier->name;
            })
            ->addColumn('total', function (Purchase $purchase) {
                return price_format($purchase->total);
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
        $query = Purchase::query()->with(['supplier', 'purchase_items']);

        if (request()->supplier_id) {
            $query->where('supplier_id', request()->supplier_id);
        }

        if (request()->open) {
            $query->where('processed_at', null);
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
            'id'           => ['title' => 'Purchase #'],
            'supplier'     => ['name' => 'supplier.name', 'sortable' => false, 'searchable' => true],
            'processed_at' => ['title' => 'Processed At'],
            'created_at'   => ['title' => 'Created Date'],
            'total'        => ['orderable' => false, 'searchable' => false, 'class' => 'text-right'],
            'actions'      => ['orderable' => false, 'searchable' => false, 'class' => 'text-center']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'purchases_' . time();
    }
}
