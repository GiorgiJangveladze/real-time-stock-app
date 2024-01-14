<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Contracts\StockContract;
use App\Models\Company;

class FetchStockData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(){}

    /**
     * Execute the job.
     */
    public function handle(StockContract $stockService): void
    {
        try {
            $companies = Company::get();
            if(!empty($companies)) {
                foreach($companies as $company) {
                    $stocks = $stockService->run($company->name);
                    if(!empty($stocks)) {
                        foreach($stocks as $stock) {
                            $company->stocks()->updateOrCreate([
                                'report_date' => $stock['report_date']
                            ], $stock);
                        }
                    }
                }
                Log::info('Stock price data fetched and stored successfully');
            }
        } catch (\Exception $e) {
            Log::error('Error! fetching stock price data failed', ['error' => $e->getMessage()]);
        }
    }
}
