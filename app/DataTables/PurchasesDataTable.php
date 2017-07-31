<?php

namespace App\DataTables;

use App\Models\Purchase;
use Yajra\Datatables\Services\DataTable;

class PurchasesDataTable extends DataTable
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
            ->addColumn('actions', function (Purchase $purchase) {
                return view('purchase.datatable._actions', compact('purchase'));
            })
            ->editColumn('supplier', function (Purchase $purchase) {
                return $purchase->supplier->name;
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
        $query = Purchase::query()->with(['supplier', 'items']);

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
            'id'           => ['title' => 'Purchase #'],
            'supplier'     => ['name' => 'supplier.name', 'sortable' => false, 'searchable' => true],
            'created_at'   => ['title' => 'Created Date'],
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
        return 'purchases_' . time();
    }
}
