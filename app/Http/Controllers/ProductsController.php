<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view('product.create');
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
            'sku'         => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|numeric',
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
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
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

        return view('product.edit', compact('product'));
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
        $this->validate(request(), [
            'description' => 'required|string',
            'price'       => 'required|numeric',
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
        $product->delete();

        notify()->flash('Product has been archived!', 'success');
        return redirect()->action('ProductsController@index');
    }
}
