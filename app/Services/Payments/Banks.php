<?php

namespace App\Services\Payments;
use App\Services\Payments\Upload\File\CSV\CSVUploader;
use App\Services\Payments\Upload\File\CSV\SberbankCSVUploader;
use App\Services\Payments\Upload\File\CSV\TinkoffCSVUploader;

enum Banks:string
{
    case Sberbank = 'sberbank';
    case Tinkoff = 'tinkoff';

    function getCSVParser():CSVUploader
    {
      return match ($this){
            Banks::Tinkoff => new TinkoffCSVUploader(),
            Banks::Sberbank => new SberbankCSVUploader(),
        };
    }
}
