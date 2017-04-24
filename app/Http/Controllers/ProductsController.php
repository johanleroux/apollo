<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $products = Product::paginate(25);
    return view('product.index', compact('products'));
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
  public function store(Request $request)
  {
    $this->validate($request, [
      'sku'         => 'required|string',
      'description' => 'required|string',
      'price'       => 'required|numeric',
    ]);

    $product = Product::create([
      'sku'         => $request->sku,
      'description' => $request->description,
      'price'       => $request->price,
    ]);

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
  public function update(Request $request, $id)
  {
    $product = Product::findOrFail($id);

    $this->validate($request, [
    'description' => 'required|string',
    'price'       => 'required|numeric',
    ]);

    $product->update([
    'description' => $request->description,
    'price'       => $request->price,
    ]);

    return redirect()->action('ProductsController@show', $id);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
