<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\PurchasesDataTable;

class PurchasesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(PurchasesDataTable $dt)
    {
        return $dt->render('purchase.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $suppliers = Supplier::with(['products'])->get();

        return view('purchase.create', compact('suppliers'));
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
            'supplier_id'          => 'required|exists:suppliers,id',
            'product.1.sku'        => 'required',
            'product.*.sku'        => [
                'nullable',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->where('supplier_id', request()->supplier_id);
                })
            ],
            'product.*.unit_price'               => 'nullable|required_with:product.*.sku|numeric|min:1',
            'product.*.quantity'                 => 'nullable|required_with:product.*.sku|numeric|min:1',
        ], [
            'supplier_id.required'               => 'A Supplier ID is Required',
            'product.1.sku.required'             => 'Atleast 1 Product is Required',
            'product.*.sku.exists'               => 'The Select SKU is Invalid',
            'product.*.unit_price.required_with' => 'Unit Price Field is Required',
            'product.*.quantity.required_with'   => 'Quantity Field is Required'
        ]);

        $purchase = Purchase::forceCreate([
            'supplier_id' => request()->supplier_id
        ]);

        $products = collect(request()->product)
        ->where('sku', '!=', '')
        ->each(function ($item) use ($purchase) {
            $purchase->addProduct([
                'purchase_id' => $purchase->id,
                'product_id'  => $item['sku'],
                'price'       => $item['unit_price'],
                'quantity'    => $item['quantity'],
            ]);
        });

        notify()->flash('Purchase has been created!', 'success');
        return action('PurchasesController@show', $purchase);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $purchase = Purchase::with(['supplier', 'items.product'])->findOrFail($id);
        $company = Company::firstOrFail();

        return view('purchase.show', [
            'purchase' => $purchase,
            'items'    => $purchase->items,
            'supplier' => $purchase->supplier,
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
        $purchase = Purchase::findOrFail($id);

        return view('purchase.edit', compact('purchase'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Purchase $purchase)
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

        $purchase->update(request()->all());

        notify()->flash('Purchase has been updated!', 'success');
        return redirect()->action('PurchasesController@show', $purchase);
    }

    public function process(Purchase $purchase)
    {
        abort_if($purchase->processed_at, 403);

        $this->validate(request(), [
            'ext_invoice' => 'required|string',
        ]);

        $purchase->forceFill([
            'ext_invoice'  => request()->ext_invoice,
            'processed_at' => \Carbon\Carbon::now()
        ]);

        $purchase->save();

        notify()->flash('Purchase has been processed!', 'success');
        return action('PurchasesController@show', $purchase);
    }
}
