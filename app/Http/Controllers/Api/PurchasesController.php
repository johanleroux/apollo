<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Transformers\PurchaseTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class PurchasesController extends ApiController
{
    /**
     * Returns all instances of the model
     *
     * @return json
     */
    public function index()
    {
        $open = request()->query('open') ? true : false;
        
        if ($open) {
            $paginator = Purchase::where('processed_at', null)->orderBy('id', 'desc')->paginate(25);
        } else {
            $paginator = Purchase::where('processed_at', '!=', null)->orderBy('id', 'desc')->paginate(25);
        }

        $purchases = $paginator->getCollection();

        return response()
            ->json(fractal()
            ->collection($purchases, new PurchaseTransformer())
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
        $purchase = Purchase::findOrFail($id);

        $this->authorize('view', $purchase);

        return response()
            ->json(fractal()
            ->item($purchase, new PurchaseTransformer())
            ->parseIncludes(['items'])
            ->toArray());
    }

    /**
     * Update the instance of the model
     *
     * @param int $id
     * @return json
     */
    public function update(Purchase $purchase)
    {
        $this->authorize('update', $purchase);

        $this->validate(request(), [
            'invoice_number' => 'required|string',
            'invoice_image'  => 'required|image',
        ]);

        $ext_invoice_image = request()->file('invoice_image')->store('ext_invoices', 'public');

        $purchase->forceFill([
            'ext_invoice_number' => request()->invoice_number,
            'ext_invoice_image'  => $ext_invoice_image,
            'processed_at'       => \Carbon\Carbon::now()
        ]);

        $purchase->save();

        if (auth()->check() && auth()->user()->name != 'test') {
            $items = PurchaseItem::where('purchase_id', $purchase->id)->pluck('product_id');
            $products = Product::whereIn('id', $items)->get();
            $products->each(function ($product) {
                dispatch(new \App\Jobs\GenerateForecast($product->id));
            });
        }

        return response()
            ->json(fractal()
            ->item($purchase, new PurchaseTransformer())
            ->toArray());
    }
}
