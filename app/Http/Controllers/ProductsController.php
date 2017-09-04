<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SaleItem;
use App\Models\Forecast;
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
        return $dt->render('product.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $this->authorize('create', Product::class);

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
        $this->authorize('create', Product::class);

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
    public function show(Product $product)
    {
        $this->authorize('view', $product);

        $query = new \App\Queries\Report;

        $report['quantity'] = $query->recap($product->id, 'quantity');
        $report['forecast'] = $query->forecast($product->id);
        $report['sales']    = $product->latestSales();

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
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);

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
        $this->authorize('update', $product);

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
        $this->authorize('delete', $product);

        $product->delete();

        notify()->flash('Product has been archived!', 'success');
        return redirect()->action('ProductsController@index');
    }

    public function forecast(Product $product)
    {
        $this->validate(request(), [
            'adjusted_forecast' => 'required|numeric|min:0',
            'year'              => 'required|numeric|min:2017',
            'month'             => 'required|numeric|min:1|max:12',
        ]);

        $forecast = Forecast::updateOrCreate([
            'product_id'  => $product->id,
            'year'  => request()->year,
            'month' => request()->month
        ], [
            'adjusted_forecast' => request()->adjusted_forecast
        ]);

        notify()->flash('Forecast has been created!', 'success');
        return action('ProductsController@show', $product);
    }
}
