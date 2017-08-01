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
        $this->validate(request(), [
            'customer_id'                        => 'required|exists:customers,id',
            'product.1.sku'                      => 'required',
            'product.*.sku'                      => 'nullable|exists:products,id',
            'product.*.unit_price'               => 'nullable|required_with:product.*.sku|numeric|min:1',
            'product.*.quantity'                 => 'nullable|required_with:product.*.sku|numeric|min:1',
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
                'sale_id' => $sale->id,
                'product_id'  => $item['sku'],
                'price'       => $item['unit_price'],
                'quantity'    => $item['quantity'],
            ]);
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
        $sale = Sale::with(['customer', 'items.product'])->findOrFail($id);
        $company = Company::firstOrFail();

        return view('sale.show', [
            'sale'     => $sale,
            'items'    => $sale->items,
            'customer' => $sale->customer,
            'company'  => $company
        ]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);

        return view('sale.edit', compact('sale'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Sale $sale)
    {
        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|string',
            'address'   => 'nullable|string',
            'address_2' => 'nullable|string',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'country'   => 'nullable|string',
        ]);

        $sale->update(request()->all());

        notify()->flash('Sale has been updated!', 'success');
        return redirect()->action('SalesController@show', $sale);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        notify()->flash('Sale has been archived!', 'success');
        return redirect()->action('SalesController@index');
    }
}
