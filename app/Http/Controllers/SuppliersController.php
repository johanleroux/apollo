<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $suppliers = Supplier::paginate(25);
    return view('supplier.index', compact('suppliers'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('supplier.create');
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
      'name'  => 'required|string',
      'email' => 'required|email',
    ]);

    $supplier = Supplier::create([
      'name'      => $request->name,
      'telephone' => $request->telephone,
      'email'     => $request->email,
      'address'   => $request->address,
      'address_2' => $request->address_2,
      'city'      => $request->city,
      'province'  => $request->province,
      'country'   => $request->country,
      ]);

      return redirect()->action('SuppliersController@index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      $supplier = Supplier::findOrFail($id);
      return view('supplier.show', compact('supplier'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $supplier = Supplier::findOrFail($id);
      return view('supplier.edit', compact('supplier'));
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
      $supplier = Supplier::findOrFail($id);

      $this->validate($request, [
      'name'  => 'required|string',
      'email' => 'required|email',
      ]);

      $supplier->update([
      'name'      => $request->name,
      'telephone' => $request->telephone,
      'email'     => $request->email,
      'address'   => $request->address,
      'address_2' => $request->address_2,
      'city'      => $request->city,
      'province'  => $request->province,
      'country'   => $request->country,
      ]);

      return redirect()->action('SuppliersController@edit', $id);
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
