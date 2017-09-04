<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleItem;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    public function forecast()
    {
        $product = Product::findOrFail(request()->product_id);
        $reportQuery = new \App\Queries\Report();

        $forecast = $reportQuery->forecast($product->id);

        Excel::create($product->sku . '_forecast', function ($excel) use ($product, $forecast) {
            // Set the title
            $excel->setTitle($product->sku . '_forecast')
            ->setCreator('Apollo')
            ->setCompany('Apollo');

            $excel->sheet('Recap', function ($sheet) use ($forecast) {
                $sheet->setOrientation('landscape');
                $sheet->loadView('csv.forecast', compact('forecast'));
            });
        })->download('csv');
    }

    public function recap()
    {
        if (request()->product_id) {
            $product = Product::findOrFail(request()->product_id);
            $reportQuery = new \App\Queries\Report();

            $report['quantity'] = $reportQuery->recap($product->id, 'quantity');
            $report['value'] = $reportQuery->recap($product->id, 'value');

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
        } else {
            $reportQuery = new \App\Queries\Report($preload = true);

            $report['quantity'] = $reportQuery->recap(null, 'quantity');
            $report['value'] = $reportQuery->recap(null, 'value');

            Excel::create('Products_recap', function ($excel) use ($report) {
                // Set the title
                $excel->setTitle('Products_recap')
                ->setCreator('Apollo')
                ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($report) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.recap', compact('report'));
                });
            })->download('csv');
        }
    }

    public function sales()
    {
        if (request()->product_id) {
            $product = Product::findOrFail(request()->product_id);
            $sales = SaleItem::with('sale.customer')->where('product_id', $product->id)->get();

            Excel::create($product->sku . '_sales', function ($excel) use ($product, $sales) {
                $excel->setTitle($product->sku . '_sales')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($sales) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.sales', compact('sales'));
                });
            }
            )->download('csv');
        } else {
            $sales = SaleItem::with('sale.customer')->get();

            Excel::create('Products_sales', function ($excel) use ($sales) {
                $excel->setTitle('Products_sales')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($sales) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.sales', compact('sales'));
                });
            }
            )->download('csv');
        }
    }

    public function purchases()
    {
        if (request()->product_id) {
            $product = Product::findOrFail(request()->product_id);
            $purchases = PurchaseItem::with('purchase.supplier')->where('product_id', $product->id)->get();

            Excel::create($product->sku . '_purchases', function ($excel) use ($product, $purchases) {
                $excel->setTitle($product->sku . '_purchases')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($purchases) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.purchases', compact('purchases'));
                });
            }
            )->download('csv');
        } else {
            $purchases = PurchaseItem::with('purchase.supplier')->get();

            Excel::create('Products_purchases', function ($excel) use ($purchases) {
                $excel->setTitle('Products_purchases')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($purchases) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.purchases', compact('purchases'));
                });
            }
            )->download('csv');
        }
    }

    public function open_purchases()
    {
        if (request()->product_id) {
            $open = Purchase::where('processed_at', null)->pluck('id');
            $product = Product::findOrFail(request()->product_id);
            $purchases = PurchaseItem::whereIn('purchase_id', $open)
                ->where('product_id', $product->id)
                ->with(['purchase.supplier'])
                ->get();

            Excel::create($product->sku . '_open_purchases', function ($excel) use ($product, $purchases) {
                $excel->setTitle($product->sku . '_open_purchases')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($purchases) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.purchases', compact('purchases'));
                });
            })->download('csv');
        } else {
            $open = Purchase::where('processed_at', null)->pluck('id');
            $purchases = PurchaseItem::whereIn('purchase_id', $open)
                ->with(['purchase.supplier'])
                ->get();

            Excel::create('Products_open_purchases', function ($excel) use ($purchases) {
                $excel->setTitle('Products_open_purchases')
                    ->setCreator('Apollo')
                    ->setCompany('Apollo');

                $excel->sheet('Recap', function ($sheet) use ($purchases) {
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('csv.purchases', compact('purchases'));
                });
            })->download('csv');
        }
    }
}
