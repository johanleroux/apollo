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
        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|string',
            'address'   => 'string',
            'address_2' => 'string',
            'city'      => 'string',
            'province'  => 'string',
            'country'   => 'string',
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
        $this->validate(request(), [
            'name'      => 'required|string',
            'telephone' => 'required|string',
            'email'     => 'required|string',
            'address'   => 'string',
            'address_2' => 'string',
            'city'      => 'string',
            'province'  => 'string',
            'country'   => 'string',
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
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response(null, 204);
    }
}
