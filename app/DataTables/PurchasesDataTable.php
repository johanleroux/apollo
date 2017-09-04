<?php

namespace App\DataTables;

use App\Models\Purchase;
use App\Models\PurchaseItem;
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
            ->editColumn('id', function (Purchase $purchase) {
                $url = action('PurchasesController@show', $purchase);
                return "<a href='$url'>$purchase->id</a>";
            })
            ->editColumn('supplier', function (Purchase $purchase) {
                $url = action('SuppliersController@show', $purchase->supplier);
                $text = $purchase->supplier->name;
                return "<a href='$url'>$text</a>";
            })
            ->addColumn('total', function (Purchase $purchase) {
                return price_format($purchase->total);
            })
            ->rawColumns(['id', 'supplier']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Purchase::query()->with(['supplier', 'purchaseItems']);

        if (request()->supplier_id) {
            $query->where('supplier_id', request()->supplier_id);
        }

        if (request()->product_id) {
            $purchases = PurchaseItem::where('product_id', request()->product_id)->pluck('purchase_id');
            $query->whereIn('id', $purchases);
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
            'id' => [
                'title' => 'Purchase #'
            ],
            'supplier' => [
                'name'       => 'supplier.name',
                'sortable'   => false,
                'searchable' => true
            ],
            'created_at' => [
                'title' => 'Created Date',
                'class' => 'text-right'
            ],
            'processed_at' => [
                'title' => 'Processed At',
                'class' => 'text-right'
            ],
            'total' => [
                'orderable'  => false,
                'searchable' => false,
                'class'      => 'text-right'
            ],
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
