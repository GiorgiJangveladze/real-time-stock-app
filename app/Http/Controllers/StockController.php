<?php

namespace App\Http\Controllers;
use App\Http\Resources\StockResource;
use Illuminate\Support\Facades\Cache;
use App\Models\Stock;

class StockController extends Controller
{
    public function index() {
        try {
            $data = Cache::get('stock_data');
            if (!$data) {
                $data = Stock::stockPriceData();
            }
            return response()->json(['data' => StockResource::collection($data)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}