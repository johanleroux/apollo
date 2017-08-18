<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Transformers\ProductTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ProductsController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        $paginator = Product::paginate(25);
        $products = $paginator->getCollection();

        return response()
            ->json(fractal()
            ->collection($products, new ProductTransformer())
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
        $product = Product::findOrFail($id);

        $this->authorize('view', $product);

        return response()
            ->json(fractal()
            ->item($product, new ProductTransformer())
            ->toArray());
    }

    /**
     * Creates an instance of the model
     *
     * @return json
     */
    public function store()
    {
        $this->authorize('create', Product::class);

        $this->validate(request(), [
            'supplier_id'               => 'required|exists:suppliers,id',
            'sku'                       => 'required|unique:products|string|alpha_dash',
            'description'               => 'required|string',
            'cost_price'                => 'required|numeric|min:0',
            'retail_price'              => 'required|numeric|min:0',
            'recommended_selling_price' => 'required|numeric|min:0',
        ], [
            'supplier_id.required' => 'The supplier field is required.',
            'supplier_id.exists'   => 'The supplier field is required.',
        ]);

        return response()
            ->json(fractal()
            ->item(Product::create(request()->all()), new ProductTransformer())
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
        $this->authorize('update', $product);

        $this->validate(request(), [
            'description'               => 'required|string',
            'cost_price'                => 'required|numeric|min:0',
            'retail_price'              => 'required|numeric|min:0',
            'recommended_selling_price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update(request()->all());

        return response()
            ->json(fractal()
            ->item($product, new ProductTransformer())
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
        $this->authorize('delete', $product);

        $product = Product::findOrFail($id);
        $product->delete();

        return response(null, 204);
    }
}
