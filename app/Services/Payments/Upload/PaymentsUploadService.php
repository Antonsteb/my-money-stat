<?php

namespace App\Services\Payments\Upload;

use App\Models\payments\PaymentsUpload;

class PaymentsUploadService
{

    public function __construct(
        private readonly PaymentsUpload $paymentsUpload
    )
    {
    }

    public function upload($params): void
    {
        echo $params->path;
        if ($this->paymentsUpload->type === TypeLoader::File){
            $this->uploadCSV($params->path);
        }
    }

    private function uploadCSV(string $path): void
    {
      $countPaymentsLoad = $this->paymentsUpload->bank_name->getCSVParser()->parse($this->paymentsUpload->user, $path);
      $this->paymentsUpload->count_payments = $countPaymentsLoad;
      $this->paymentsUpload->save();
    }

}
