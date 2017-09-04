<?php

namespace App\DataTables;

use App\Models\Sale;
use App\Models\SaleItem;
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
            ->editColumn('id', function (Sale $sale) {
                $url = action('SalesController@show', $sale);
                return "<a href='$url'>$sale->id</a>";
            })
            ->addColumn('actions', function (Sale $sale) {
                return view('sale.datatable._actions', compact('sale'));
            })
            ->editColumn('customer', function (Sale $sale) {
                $url = action('CustomersController@show', $sale->customer);
                $text = $sale->customer->name;
                return "<a href='$url'>$text</a>";
            })
            ->addColumn('sub_total', function (Sale $sale) {
                return price_format($sale->sub_total);
            })
            ->addColumn('total', function (Sale $sale) {
                return price_format($sale->total);
            })
            ->rawColumns(['id', 'customer']);
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

        if (request()->product_id) {
            $sales = SaleItem::where('product_id', request()->product_id)->pluck('sale_id');
            $query->whereIn('id', $sales);
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
                'title' => 'Sale #'
            ],
            'customer' => [
                'name'       => 'customer.name',
                'orderable'  => false,
                'searchable' => true
            ],
            'created_at' => [
                'title' => 'Created Date',
                'class' => 'text-right'
            ],
            'sub_total' => [
                'orderable'  => false,
                'searchable' => false,
                'class'      => 'text-right'
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
        return 'sales_' . time();
    }
}
