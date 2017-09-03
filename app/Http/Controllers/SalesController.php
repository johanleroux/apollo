<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\SalesDataTable;

class SalesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(SalesDataTable $dt)
    {
        return $dt->render('sale.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $this->authorize('create', Sale::class);

        $customers = Customer::get();
        $products = Product::get();

        return view('sale.create', compact('customers', 'products'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        $this->authorize('create', Sale::class);

        $this->validate(request(), [
            'customer_id'                        => 'required|exists:customers,id',
            'product.1.sku'                      => 'required',
            'product.*.sku'                      => 'nullable|exists:products,id',
            'product.*.unit_price'               => 'nullable|required_with:product.*.sku|numeric|min:1',
            'product.*.quantity'                 => 'nullable|required_with:product.*.sku|numeric|min:1|has_stock:product.*.sku',
        ], [
            'customer_id.required'               => 'A Customer ID is Required',
            'product.1.sku.required'             => 'Atleast 1 Product is Required',
            'product.*.sku.exists'               => 'The Select SKU is Invalid',
            'product.*.unit_price.required_with' => 'Unit Price Field is Required',
            'product.*.quantity.required_with'   => 'Quantity Field is Required'
        ]);

        $sale = Sale::forceCreate([
            'customer_id' => request()->customer_id
        ]);

        $products = collect(request()->product)
        ->where('sku', '!=', '')
        ->each(function ($item) use ($sale) {
            $sale->addProduct([
                'sale_id'     => $sale->id,
                'product_id'  => $item['sku'],
                'price'       => $item['unit_price'],
                'quantity'    => $item['quantity'],
            ]);
        });

        // TODO
        // $sale->saleItems->each(function ($item) {
        //     dispatch(new \App\Jobs\GenerateForecast($item->product_id));
        // });

        notify()->flash('Sale has been created!', 'success');
        return action('SalesController@show', $sale);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $sale = Sale::with(['customer', 'saleItems.product'])->findOrFail($id);

        $this->authorize('view', $sale);

        $company = Company::firstOrFail();

        return view('sale.show', [
            'sale'       => $sale,
            'saleItems' => $sale->saleItems,
            'customer'   => $sale->customer,
            'company'    => $company
        ]);
    }
}
