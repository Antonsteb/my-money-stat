<?php

namespace App\Services\Payments\Upload\File\Parsers\CSV;

use App\Services\Payments\Banks;
use Illuminate\Support\Carbon;

class TinkoffCSVParser extends CSVParser
{

    protected function convertLine(array $line): array | false
    {
        if ($line[3]!=='OK' || $line[4] > 0){
            return false;
        };

        return [
            'bank_name' => Banks::Tinkoff,
            'bank_category_name' => $line[9],
            'description' => $line[11],
            'price' => floatval($line[6]),
            'date' => Carbon::parse($line[1]),
        ];
    }
}
