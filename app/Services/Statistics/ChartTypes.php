<?php

namespace App\Services\Statistics;
use App\Services\Payments\Upload\File\Parsers\CSV\CSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\SberbankCSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\TinkoffCSVParser;

enum ChartTypes:string
{
    case Sberbank = 'sberbank';
    case Tinkoff = 'tinkoff';

    function getCSVParser():CSVParser
    {
      return match ($this){
            ChartTypes::Tinkoff => new TinkoffCSVParser(),
            ChartTypes::Sberbank => new SberbankCSVParser(),
        };
    }
}
