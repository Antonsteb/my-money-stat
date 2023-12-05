<?php

namespace App\Services\Payments\Upload\File\Parsers\CSV;

class SberbankCSVParser extends CSVParser
{

    protected function convertLine(array $line): array
    {
        return [];
    }
}
