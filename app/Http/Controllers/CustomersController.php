<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
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
    $customers = Customer::paginate(25);
    return view('customer.index', compact('customers'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('customer.create');
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

    $customer = Customer::create([
      'name'      => $request->name,
      'telephone' => $request->telephone,
      'email'     => $request->email,
      'address'   => $request->address,
      'address_2' => $request->address_2,
      'city'      => $request->city,
      'province'  => $request->province,
      'country'   => $request->country,
      ]);

      return redirect()->action('CustomersController@index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      $customer = Customer::findOrFail($id);
      return view('customer.show', compact('customer'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $customer = Customer::findOrFail($id);
      return view('customer.edit', compact('customer'));
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
      $customer = Customer::findOrFail($id);

      $this->validate($request, [
      'name'  => 'required|string',
      'email' => 'required|email',
      ]);

      $customer->update([
      'name'      => $request->name,
      'telephone' => $request->telephone,
      'email'     => $request->email,
      'address'   => $request->address,
      'address_2' => $request->address_2,
      'city'      => $request->city,
      'province'  => $request->province,
      'country'   => $request->country,
      ]);

      return redirect()->action('CustomersController@edit', $id);
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
