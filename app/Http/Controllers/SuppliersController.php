<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\DataTables\SuppliersDataTable;

class SuppliersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(SuppliersDataTable $dt)
    {
        return $dt->render('supplier.index');
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
    public function store()
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

        $supplier = Supplier::create(request()->all());

        notify()->flash('Supplier has been created!', 'success');
        return redirect()->action('SuppliersController@show', $supplier);
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
    public function update(Supplier $supplier)
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

        $supplier->update(request()->all());

        notify()->flash('Supplier has been updated!', 'success');
        return redirect()->action('SuppliersController@show', $supplier);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        notify()->flash('Supplier has been archived!', 'success');
        return redirect()->action('SuppliersController@index');
    }
}
