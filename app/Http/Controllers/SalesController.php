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
        user_can('view-sale');

        return $dt->render('sale.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        user_can('create-sale');

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
        user_can('create-sale');

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

        $sale->items->each(function ($item) {
            dispatch(new \App\Jobs\GenerateForecast($item->product_id));
        });

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
        user_can('view-sale');

        $sale = Sale::with(['customer', 'items.product'])->findOrFail($id);
        $company = Company::firstOrFail();

        return view('sale.show', [
            'sale'     => $sale,
            'items'    => $sale->items,
            'customer' => $sale->customer,
            'company'  => $company
        ]);
    }
}
