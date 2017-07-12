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
        $this->validate(request(), [
            'sku'         => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|numeric',
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
        $this->validate(request(), [
            'sku'         => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|numeric',
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
        $product = Product::findOrFail($id);
        $product->delete();

        return response(null, 204);
    }
}
