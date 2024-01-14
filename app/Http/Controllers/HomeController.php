<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\StockContract;
use App\Models\Company;
use App\Models\Stock;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\StockResource;

class HomeController extends Controller
{
    private $stockService;

    public function __construct(StockContract $stockService)
    {
        $this->stockService = $stockService;
    }

    public function getStock() {
        $stocks = Stock::stockPriceData();
        Cache::put('test', $stocks, 1);
        $data = Cache::get('test');
        // return response()->json(['data' => StockResource::collection($data)], 200);
        // $companyDetailDto = CompanyDetailDto::fromRequest($request);
        // $companies =  Company::where('id', 1)->get();
        // ['AAPL', 'GOOGL', 'MSFT']IBM
        // $data = $this->stockService->run($companies);
        // $companies = Company::get();
        // if(!empty($companies)) {
        //     foreach($companies as $company) {
        //         $stocks = $this->stockService->run($company->name);
        //         if(!empty($stocks)) {
        //             foreach($stocks as $stock) {
        //                 $company->stocks()->updateOrCreate([
        //                     'report_date' => $stock['report_date']
        //                 ], $stock);
        //             }
        //         }
        //     }
        // }

        return 'test';

        // $stockData = [];

        // foreach ($symbols as $symbol) {
        //     $stockData[$symbol] = $this->stockService->getStockData($symbol);
        // }

        // return $stockData;
    }
}
