<?php

namespace App\Services\Statistics;
use App\Services\Payments\Upload\File\Parsers\CSV\CSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\SberbankCSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\TinkoffCSVParser;

enum ChartTypes:string
{
    case Number = 'number';
    case Line = 'line';
    case Bar = 'bar';

}
