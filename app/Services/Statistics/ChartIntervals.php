<?php

namespace App\Services\Statistics;
use App\Services\Payments\Upload\File\Parsers\CSV\CSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\SberbankCSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\TinkoffCSVParser;

enum ChartIntervals:string
{
    case Day = 'day';
    case Month = 'month';
//    case Year = 'year';

    public static function getValueNameList(): array
    {
        return [
            self::Day->value => 'День',
            self::Month->value => 'Месяц',
//            self::Year->value => 'Год',
        ];
    }

}
