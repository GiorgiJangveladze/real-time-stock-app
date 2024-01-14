<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [ "name" => "AMZN"],
            [ "name" => "FB"],
            [ "name" => "TSLA"],
            [ "name" => "NVDA"],
            [ "name" => "PYPL"],
            [ "name" => "IBM"],
            [ "name" => "INTC"],
            [ "name" => "CSCO"],
            [ "name" => "NFLX"],
            [ "name" => "DIS"],
            [ "name" => "AAPL"],
            [ "name" => "GOOGL"],
            [ "name" => "MSFT"]
        ]);
    }
}
