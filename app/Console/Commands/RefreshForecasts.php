<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Product;
use App\Jobs\GenerateForecast;
use Illuminate\Console\Command;

class RefreshForecasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:refresh {product?} {--all : Whether all products\' forecasts should be refreshed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh forecast for a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->info('Forecasting All Products');
            $productsCount = Product::count();
            for ($i=1; $i <= $productsCount; $i++) {
                $this->generate($i);
            }
        } elseif ($this->argument('product')) {
            $id = $this->argument('product');
            $this->info('Forecasting Product ' . $id);
            $this->generate($id);
        } else {
            $this->error('Have to select a product to forecast!');
        }
    }

    protected function generate($id)
    {
        $job = (new GenerateForecast($id));
        dispatch($job);
    }
}
