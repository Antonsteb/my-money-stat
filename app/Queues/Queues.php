<?php

namespace App\Queues;

use App\Queues\Handlers\PaymentsUploadHandler;
use App\Queues\Handlers\QueueHandlerInterface;
use App\Queues\Handlers\StatisticsUpdateHandler;

enum Queues: string
{
    case PaymentsUploads = 'payments.uploads';
    case StatisticsUpdate = 'statistics.update';

    public function getHandler(): QueueHandlerInterface
    {
        return match ($this){
            Queues::PaymentsUploads => new PaymentsUploadHandler(),
            Queues::StatisticsUpdate => new StatisticsUpdateHandler()
        };
    }
}
