<?php

if (! function_exists('alphaVantageDataFormater')) {
    function alphaVantageDataFormater(array $data): array
    {
        $formatedData = [];
        if(!empty($data['Time Series (1min)'])) {
            foreach($data['Time Series (1min)'] as $key => $item) {
                $formatedData[] = [
                    'report_date' => $key,
                    'open' => (float)$item['1. open'],
                    'high' => (float)$item['2. high'],
                    'low' => (float)$item['3. low'],
                    'close' => (float)$item['4. close'],
                    'volume' => (int)$item['5. volume']
                ];
            }
        }
        return $formatedData;
    }
}