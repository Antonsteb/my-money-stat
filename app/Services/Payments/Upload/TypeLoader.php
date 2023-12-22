<?php

namespace App\Services\Payments\Upload;

use App\Services\Payments\Banks;

enum TypeLoader: string
{
    case File = 'file';
    case Api = 'api';
    case User = 'user';


    public function getUploader(Banks $banks): UploaderInterface
    {
        return match ($this){
            self::File => $banks->getCSVParser(),
            self::Api => 'future',
            self::User => 'future2'
        };
    }
}
