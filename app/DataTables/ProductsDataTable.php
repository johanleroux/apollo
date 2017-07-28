<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\Datatables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('actions', function (Product $product) {
                return view('product.datatable._actions', compact('product'));
            })
            ->editColumn('supplier', function (Product $product) {
                return $product->supplier->name;
            })
            ->editColumn('cost_price', function (Product $product) {
                return price_format($product->cost_price);
            })
            ->editColumn('retail_price', function (Product $product) {
                return price_format($product->retail_price);
            })
            ->editColumn('recommended_selling_price', function (Product $product) {
                return price_format($product->recommended_selling_price);
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
        $query = Product::query()->with(['supplier']);

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
            'sku'                       => ['title' => 'SKU', 'width' => '50'],
            'supplier'                  => ['title' => 'Supplier', 'name' => 'supplier.name'],
            'description',
            'cost_price'                => ['title' => 'Cost Price', 'width' => '50', 'class' => 'text-right'],
            'retail_price'              => ['title' => 'Retail Price', 'width' => '50', 'class' => 'text-right'],
            'recommended_selling_price' => ['title' => 'RSP', 'width' => '50', 'class' => 'text-right'],
            'actions',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'product_' . time();
    }
}
