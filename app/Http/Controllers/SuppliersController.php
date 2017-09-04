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
        $this->authorize('create', Supplier::class);

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
        $this->authorize('create', Supplier::class);

        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|email',
            'address'   => 'nullable|string',
            'address_2' => 'nullable|string',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'country'   => 'nullable|string',
            'lead_time' => 'required|numeric|min:0',
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
        $supplier = Supplier::withTrashed()->findOrFail($id);

        $this->authorize('view', $supplier);

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

        $this->authorize('update', $supplier);

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
        $this->authorize('update', $supplier);

        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|email',
            'address'   => 'nullable|string',
            'address_2' => 'nullable|string',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'country'   => 'nullable|string',
            'lead_time' => 'required|numeric|min:0',
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
        $this->authorize('delete', $supplier);

        $supplier->delete();

        notify()->flash('Supplier has been archived!', 'success');
        return redirect()->action('SuppliersController@index');
    }
}
