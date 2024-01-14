<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\StockContract;
use App\Services\Stock\AlphaVantageService;

class StockServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StockContract::class, function ($app) {
            return new AlphaVantageService();
        });
    }
}
