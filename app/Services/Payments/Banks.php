<?php

namespace App\Services\Payments;
use App\Services\Payments\Upload\File\Parsers\CSV\CSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\SberbankCSVParser;
use App\Services\Payments\Upload\File\Parsers\CSV\TinkoffCSVParser;

enum Banks:string
{
    case Sberbank = 'sberbank';
    case Tinkoff = 'tinkoff';

    function getCSVParser():CSVParser
    {
      return match ($this){
            Banks::Tinkoff => new TinkoffCSVParser(),
            Banks::Sberbank => new SberbankCSVParser(),
        };
    }
}
