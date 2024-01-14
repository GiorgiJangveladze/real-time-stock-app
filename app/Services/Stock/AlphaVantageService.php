<?php

namespace App\Services\Stock;

use Illuminate\Support\Facades\Log;
use App\Contracts\StockContract;
use GuzzleHttp\Client;
use App\Exceptions\FetchStockDataException;
use App\Helpers\StockHelper;

class AlphaVantageService implements StockContract
{
    private $url;
    private $apiKey;
    private $client;
    
    public function __construct()
    {
        $this->url = config('stock.alpha_vantage.url');
        $this->apiKey = config('stock.alpha_vantage.api_key');
        $this->client = new Client;
    }

    public function run(string $option): array {
        try {
            $response = $this->fetchData($option);
            $data = json_decode($response->getBody(), true);
            $validated = $this->validation($data, $option);
            if(!empty($validated)) {
                return alphaVantageDataFormater($validated);
            }
        } catch (FetchStockDataException $e) {
            Log::error("Get Stock Price Error! Alpha Vantage API:  " . $e->getMessage());
        }
        return [];
    }

    private function fetchData(string $option): object {
        return $this->client->get($this->url, [
            'query' => [
                'function' => 'TIME_SERIES_INTRADAY',
                'symbol' => $option,
                'interval'=> '1min',
                'apikey' => $this->apiKey,
            ],
        ]);
    }

    private function validation(array $data, string $option): \Exception | array {
        if(isset($data['Error Message'])) throw new FetchStockDataException("Company $option : API key is invalid or missing.");
        if(isset($data['Information'])) throw new FetchStockDataException("Company $option : Rate Limit or Query parameters are incorrect.");
        if(!empty($data['Meta Data']) && !empty($data['Time Series (1min)'])) {
            return $data;
        }else {
            throw new FetchStockDataException("Company $option : Something went wrong.");
        }
    }
}