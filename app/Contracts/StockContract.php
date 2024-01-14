<?php

namespace App\Contracts;

interface StockContract
{
    public function run(string $option): array;
}