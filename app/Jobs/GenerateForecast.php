<?php

namespace App\Jobs;

use DB;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Forecast;
use App\Models\SaleItem;
use Illuminate\Bus\Queueable;
use Symfony\Component\Process\Process;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GenerateForecast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $sales;
    protected $product;
    protected $path;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->product = Product::findOrFail($id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Setup Forecasting
        $this->setup();

        // Create Input Data for Forecast
        $this->createInput();

        // Generate Forecast
        $this->generateForecast();

        // Save Forecast Data
        $this->saveForecast();

        Product::where('id', $this->product->id)
                ->update([
                    'last_forecast' => Carbon::now()
                ]);
        
        dispatch(new AlertLowStock($this->product->id));

        return;
    }

    protected function setup()
    {
        $this->sales = $this->product
                        ->hasMany(SaleItem::class)
                        ->select(
                            DB::raw('SUM(price * quantity) value'),
                            DB::raw('SUM(quantity) quantity'),
                            DB::raw('YEAR(created_at) year, MONTH(created_at) month')
                        )
                        ->groupBy('year', 'month')
                        ->get();

        $this->path = app_path('Queries/data/');

        if (count($this->sales) < 3) {
            $this->delete();
        }

        $lastSale = $this->sales->last();
        $this->date = Carbon::createFromDate($lastSale->year, $lastSale->month, 1)->addMonth()->startOfDay();
    }

    protected function createInput()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
        $handle = fopen($this->path . 'input.txt', 'w');

        $data = 'Time Value' . "\n";
        $firstSale = $this->sales->first();
        $date = Carbon::createFromDate($firstSale->year, $firstSale->month, 1)->startOfDay();
        $i = 1;
        while ($date < $this->date) {
            $sale = $this->sales->where('year', $date->year)->where('month', $date->month)->first();
            if ($sale) {
                $data .= $i . ' ' . $date->year . '-' . $date->month . ' ' . $sale->quantity . "\n";
            } else {
                $data .= $i . ' ' . $date->year . '-' . $date->month . ' 0' . "\n";
            }
            $i++;
            $date->addMonth();
        }
        fwrite($handle, $data);
        fclose($handle);
    }

    protected function generateForecast()
    {
        $process = new Process('Rscript ' . app_path('Queries/Forecast.R'));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    protected function saveForecast()
    {
        $handle = fopen($this->path . 'output.txt', 'r');

        while (($line = fgets($handle)) !== false) {
            preg_match_all('/-?\d*\.{0,1}\d+/', $line, $matches);
            $forecasts = $matches[0];
            if (count($forecasts) == 6) {
                $forecast = Forecast::updateOrCreate(
                    [
                        'product_id'  => $this->product->id,
                        'year'  => $this->date->year,
                        'month' => $this->date->month
                    ],
                    [
                        'forecast' => $forecasts[1]
                    ]
                );

                $this->date->addMonth();
            }
        }

        fclose($handle);
    }
}
