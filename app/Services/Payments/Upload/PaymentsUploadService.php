<?php

namespace App\Services\Payments\Upload;

use App\Models\payments\PaymentsUpload;
use App\Services\RabbitMQService;

class PaymentsUploadService
{

    public function __construct(
        private readonly PaymentsUpload $paymentsUpload
    )
    {
    }

    public function upload(object $params): void
    {
        $uploader = $this->paymentsUpload->type->getUploader($this->paymentsUpload->bank_name);
        $resulUploadDto = $uploader->upload($this->paymentsUpload->user, $params);
        $this->paymentsUpload->count_payments = $resulUploadDto->getCountPaymentsLoaded();
        $this->paymentsUpload->save();

        $message = json_encode([
            'user_id' => $this->paymentsUpload->user->id,
            'start' => $resulUploadDto->getMinDate()->format('Y-m-d'),
            'end' => $resulUploadDto->getMaxDate()->format('Y-m-d')
        ]);
        (new RabbitMQService())->publish($message,'statistics','update');
    }

}
