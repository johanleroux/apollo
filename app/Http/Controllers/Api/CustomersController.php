<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Transformers\CustomerTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CustomersController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        user_can('view-customer');

        $paginator = Customer::paginate(25);
        $customers = $paginator->getCollection();

        return response()
            ->json(fractal()
            ->collection($customers, new CustomerTransformer())
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
        user_can('view-customer');

        $customer = Customer::findOrFail($id);

        return response()
            ->json(fractal()
            ->item($customer, new CustomerTransformer())
            ->toArray());
    }

    /**
     * Creates an instance of the model
     *
     * @return json
     */
    public function store()
    {
        user_can('create-customer');

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

        return response()
            ->json(fractal()
            ->item(Customer::create(request()->all()), new CustomerTransformer())
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
        user_can('edit-customer');

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

        $customer = Customer::findOrFail($id);
        $customer->update(request()->all());

        return response()
            ->json(fractal()
            ->item($customer, new CustomerTransformer())
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
        user_can('delete-customer');

        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response(null, 204);
    }
}
