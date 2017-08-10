<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Supplier;
use App\DataTables\ProductsDataTable;

class ProductsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(ProductsDataTable $dt)
    {
        user_can('view-product');

        $report = new \App\Queries\Report;

        return $dt->render('product.index', compact('report'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        user_can('create-product');

        $suppliers = Supplier::orderBy('name', 'asc')->pluck('name', 'id');
        return view('product.create', compact('suppliers'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        user_can('create-product');

        $this->validate(request(), [
            'supplier_id'               => 'required|exists:suppliers,id',
            'sku'                       => 'required|unique:products|string|alpha_dash',
            'description'               => 'required|string',
            'cost_price'                => 'required|numeric|min:0',
            'retail_price'              => 'required|numeric|min:0',
            'recommended_selling_price' => 'required|numeric|min:0',
        ], [
            'supplier_id.required' => 'The supplier field is required.',
            'supplier_id.exists'   => 'The supplier field is required.',
        ]);

        $product = Product::create(request()->all());

        notify()->flash('Product has been created!', 'success');
        return redirect()->action('ProductsController@show', $product);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        user_can('view-product');

        $product = Product::findOrFail($id);
        $reportQuery = new \App\Queries\Report($preload = false);

        $report['quantity'] = $reportQuery->yearlyRecap($product->id, 'quantity');
        $report['forecast'] = $reportQuery->forecast($product->id);
        $report['sales'] = $reportQuery->lastSalesOfProduct($product->id);

        return view('product.show', compact('product', 'report'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        user_can('edit-product');

        $product = Product::findOrFail($id);
        $suppliers = Supplier::orderBy('name', 'asc')->pluck('name', 'id');

        return view('product.edit', compact('product', 'suppliers'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Product $product)
    {
        user_can('edit-product');

        $this->validate(request(), [
            'description'               => 'required|string',
            'cost_price'                => 'required|numeric|min:0',
            'retail_price'              => 'required|numeric|min:0',
            'recommended_selling_price' => 'required|numeric|min:0',
        ]);

        $product->update(request()->all());

        notify()->flash('Product has been updated!', 'success');
        return redirect()->action('ProductsController@show', $product);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {
        user_can('delete-product');

        $product->delete();

        notify()->flash('Product has been archived!', 'success');
        return redirect()->action('ProductsController@index');
    }
}
