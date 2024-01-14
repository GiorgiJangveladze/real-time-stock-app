<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'company_id' => $this->company_id,
            'report_date' => $this->name,
            'open' => $this->open,
            'close' => $this->close,
            'percentage' => round((($this->close - $this->open) / $this->open) * 100, 2)
        ];
    }
}