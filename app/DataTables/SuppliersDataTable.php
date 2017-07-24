<?php

namespace App\DataTables;

use App\Models\Supplier;
use Yajra\Datatables\Services\DataTable;

class SuppliersDataTable extends DataTable
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
            ->addColumn('actions', function (Supplier $supplier) {
                return view('supplier.datatable._actions', compact('supplier'));
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
        $query = Supplier::query()->select();

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
                        'order'      => [[0, 'asc']],
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
            'name',
            'telephone',
            'email',
            'address',
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
        return 'suppliers_' . time();
    }
}
