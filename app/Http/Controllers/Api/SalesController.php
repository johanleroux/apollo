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
        $paginator = Sale::orderBy('id', 'desc')->paginate(25);
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
        $sale = Sale::findOrFail($id);

        $this->authorize('view', $sale);

        return response()
            ->json(fractal()
            ->item($sale, new SaleTransformer())
            ->parseIncludes(['items'])
            ->toArray());
    }
}
