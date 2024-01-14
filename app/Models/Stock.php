<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'company_id',
        'report_date',
        'open',
        'high',
        'low',
        'close',
        'volume'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function stockPriceData()
    {
        $stocks = DB::select("SELECT
                c.id AS company_id,
                c.name,
                s.open,
                s.close,
                s.report_date
            FROM companies AS c
            JOIN (
                SELECT
                    ROW_NUMBER() OVER (
                        PARTITION BY ss.company_id
                        ORDER BY ss.report_date DESC
                    ) AS row_num,
                    ss.company_id,
                    ss.open,
                    ss.close,
                    ss.report_date
                FROM
                    stocks AS ss
            ) s ON s.company_id = c.id
            WHERE 
                s.row_num <= 1
            ORDER BY company_id, s.report_date DESC;");
        return $stocks;
    }
}
