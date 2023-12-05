<?php

namespace App\Queues;

use App\Queues\Handlers\PaymentsUploadHandler;
use App\Queues\Handlers\QueueHandlerInterface;
use App\Queues\Handlers\StatisticsHandler;

enum Queues: string
{
    case PaymentsUploads = 'payments.uploads';
    case Statistics = 'statistics';

    public function getHandler(): QueueHandlerInterface
    {
        return match ($this){
            Queues::PaymentsUploads => new PaymentsUploadHandler(),
            Queues::Statistics => new StatisticsHandler()
        };
    }
}
