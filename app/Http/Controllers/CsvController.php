<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    public function forecast(Product $product)
    {
        abort(404);
    }

    public function recap(Product $product)
    {
        $reportQuery = new \App\Queries\Report($preload = false);

        $report['quantity'] = $reportQuery->yearlyRecap($product->id, 'quantity');
        $report['value'] = $reportQuery->yearlyRecap($product->id, 'value');

        Excel::create($product->sku . '_recap', function ($excel) use ($product, $report) {
            // Set the title
            $excel->setTitle($product->sku . '_recap')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

            $excel->sheet('Recap', function ($sheet) use ($report) {
                $sheet->setOrientation('landscape');
                $sheet->loadView('csv.recap', compact('report'));
            });
        })->download('csv');
    }

    public function sales(Product $product)
    {
        $sales = SaleItem::with('sale.customer')->where('product_id', $product->id)->get();

        Excel::create($product->sku . '_sales', function ($excel) use ($product, $sales) {
            // Set the title
            $excel->setTitle($product->sku . '_sales')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

            $excel->sheet('Recap', function ($sheet) use ($sales) {
                $sheet->setOrientation('landscape');
                $sheet->loadView('csv.sales', compact('sales'));
            });
        })->download('csv');
    }

    public function purchases(Product $product)
    {
        $purchases = PurchaseItem::with('purchase.supplier')->where('product_id', $product->id)->get();

        Excel::create($product->sku . '_purchases', function ($excel) use ($product, $purchases) {
            // Set the title
            $excel->setTitle($product->sku . '_purchases')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

            $excel->sheet('Recap', function ($sheet) use ($purchases) {
                $sheet->setOrientation('landscape');
                $sheet->loadView('csv.purchases', compact('purchases'));
            });
        })->download('csv');
    }
}
