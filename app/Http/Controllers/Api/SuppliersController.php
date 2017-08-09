<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use App\Transformers\SupplierTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class SuppliersController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        user_can('view-supplier');

        $paginator = Supplier::paginate(25);
        $suppliers = $paginator->getCollection();

        return response()
            ->json(fractal()
            ->collection($suppliers, new SupplierTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray());
    }

    /**
     * Returns an instance of the model
     *
     * @param int $id
     * @return json
     */
    public function show($id)
    {
        user_can('view-supplier');

        $supplier = Supplier::findOrFail($id);

        return response()
            ->json(fractal()
            ->item($supplier, new SupplierTransformer())
            ->toArray());
    }

    /**
     * Creates an instance of the model
     *
     * @return json
     */
    public function store()
    {
        user_can('create-supplier');

        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|string',
            'address'   => 'nullable|string',
            'address_2' => 'nullable|string',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'country'   => 'nullable|string',
            'lead_time' => 'required|numeric|min:0',
        ]);

        return response()
            ->json(fractal()
            ->item(Supplier::create(request()->all()), new SupplierTransformer())
            ->toArray());
    }

    /**
     * Update the instance of the model
     *
     * @param int $id
     * @return json
     */
    public function update($id)
    {
        user_can('edit-supplier');

        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|string',
            'address'   => 'nullable|string',
            'address_2' => 'nullable|string',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'country'   => 'nullable|string',
            'lead_time' => 'required|numeric|min:0',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update(request()->all());

        return response()
            ->json(fractal()
            ->item($supplier, new SupplierTransformer())
            ->toArray());
    }

    /**
     * Deletes the instance of the model
     *
     * @param int $id
     * @return response
     */
    public function destroy($id)
    {
        user_can('delete-supplier');

        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return response(null, 204);
    }
}
