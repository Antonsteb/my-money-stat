<?php

namespace App\Services\Payments\Upload\File\CSV;

class SberbankCSVUploader extends CSVUploader
{

    protected function convertLine(array $line): array
    {
        return [];
    }
}
