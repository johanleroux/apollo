<?php

namespace App\Http\Controllers\Api;

use App\Models\Sale;
use App\Transformers\SaleTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class SalesController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        user_can('view-sale');

        $paginator = Sale::paginate(25);
        $sales = $paginator->getCollection();

        return response()
            ->json(fractal()
            ->collection($sales, new SaleTransformer())
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
        user_can('view-sale');

        $sale = Sale::findOrFail($id);

        return response()
            ->json(fractal()
            ->item($sale, new SaleTransformer())
            ->parseIncludes(['items'])
            ->toArray());
    }
}
