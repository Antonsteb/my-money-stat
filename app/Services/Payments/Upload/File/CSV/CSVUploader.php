<?php

namespace App\Services\Payments\Upload\File\CSV;

use App\Models\users\User;
use App\Services\Payments\Upload\Dto\ResulUploadDto;
use App\Services\Payments\Upload\File\Parsers\Adapters\FileParserAdapter;
use App\Services\Payments\Upload\UploaderInterface;
use Illuminate\Support\Facades\Storage;

abstract class CSVUploader implements UploaderInterface
{

    protected abstract function convertLine(array $line): array | false;

    public function upload(User $user, object $params): ResulUploadDto
    {
        $resulUploadDto = new ResulUploadDto();
        $countError = 0;
        $count = 0;
        $handle = fopen(Storage::disk('payments')->path($params->path), "r");

        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE && $countError < 5) {
                $data = array_map(fn($text) => mb_convert_encoding($text, 'UTF-8', 'windows-1251'), $data);
                try {
                    $paymentData = $this->convertLine($data);
                    if ($paymentData) {
                        $user->bankPayments()->create($paymentData);
                        $count++;
                        $resulUploadDto->setMinDate($paymentData['date']);
                        $resulUploadDto->setMaxDate($paymentData['date']);
                    }
                }catch (\Throwable $e){
                    echo $e->getMessage();die;
                    $countError++;
                }
            }
            fclose($handle);
        }
        Storage::disk('payments')->delete($params->path);
        $resulUploadDto->setCountPaymentsLoaded($count);
        return $resulUploadDto;
    }

}
