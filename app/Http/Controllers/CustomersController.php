<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\DataTables\CustomersDataTable;

class CustomersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(CustomersDataTable $dt)
    {
        return $dt->render('customer.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $this->authorize('create', Customer::class);

        return view('customer.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        $this->authorize('create', Customer::class);

        $this->validate(request(), [
            'name'       => 'required|string',
            'vat_number' => 'nullable|string',
            'telephone'  => 'required|string',
            'email'      => 'required|email',
            'address'    => 'nullable|string',
            'address_2'  => 'nullable|string',
            'city'       => 'nullable|string',
            'province'   => 'nullable|string',
            'country'    => 'nullable|string',
        ]);

        $customer = Customer::create(request()->all());

        notify()->flash('Customer has been created!', 'success');
        return redirect()->action('CustomersController@show', $customer);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);

        $this->authorize('view', $customer);

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

        $this->authorize('update', $customer);

        return view('customer.edit', compact('customer'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Customer $customer)
    {
        $this->authorize('update', $customer);

        $this->validate(request(), [
            'name'       => 'required|string',
            'vat_number' => 'nullable|string',
            'telephone'  => 'required|string',
            'email'      => 'required|email',
            'address'    => 'nullable|string',
            'address_2'  => 'nullable|string',
            'city'       => 'nullable|string',
            'province'   => 'nullable|string',
            'country'    => 'nullable|string',
        ]);

        $customer->update(request()->all());

        notify()->flash('Customer has been updated!', 'success');
        return redirect()->action('CustomersController@show', $customer);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        notify()->flash('Customer has been archived!', 'success');
        return redirect()->action('CustomersController@index');
    }
}
