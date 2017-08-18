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
        $supplier = Supplier::findOrFail($id);

        $this->authorize('view', $supplier);

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
        $this->authorize('view', Supplier::class);

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
    public function update(Supplier $supplier)
    {
        $this->authorize('update', $supplier);

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
    public function destroy(Supplier $supplier)
    {
        $this->authorize('delete', $supplier);

        $supplier->delete();

        return response(null, 204);
    }
}
