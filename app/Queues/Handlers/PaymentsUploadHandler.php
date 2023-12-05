<?php

namespace App\Queues\Handlers;

use App\Models\payments\PaymentsUpload;
use App\Services\Payments\Upload\PaymentsUploadService;

class PaymentsUploadHandler implements QueueHandlerInterface
{

    public function handle($msg): void
    {
        echo $msg->body;
        $data = json_decode($msg->body);
        /** @var PaymentsUpload $paymentsUpload точно есть иначе бы была ошибка валидации */
        $paymentsUpload = PaymentsUpload::query()->find($data->id);
        $paymentsUploadService = new PaymentsUploadService($paymentsUpload);
        $paymentsUploadService->upload($data);
    }
}
