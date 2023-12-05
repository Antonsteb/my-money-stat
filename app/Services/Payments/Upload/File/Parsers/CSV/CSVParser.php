<?php

namespace App\Services\Payments\Upload\File\Parsers\CSV;

use App\Models\payments\PaymentsUpload;
use App\Models\User;
use App\Services\Payments\Banks;
use Illuminate\Support\Facades\Storage;

abstract class CSVParser
{
    protected abstract function convertLine(array $line): array | false;

    public function parse(User $user, string $path): int
    {
        $countError = 0;
        $count = 0;
        $handle = fopen(Storage::disk('payments')->path($path), "r");

        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE && $countError < 5) {
                $data = array_map(fn($text) => mb_convert_encoding($text, 'UTF-8', 'windows-1251'), $data);
                try {
                    $paymentData = $this->convertLine($data);
                    if ($paymentData) {
                        $user->bankPayments()->create($paymentData);
                        $count++;
                    }
                }catch (\Throwable $e){
                    echo $e->getMessage();die;
                    $countError++;
                }
            }
            fclose($handle);
        }
//            Storage::disk('payments')->delete($path);
        return $count;
    }

}
