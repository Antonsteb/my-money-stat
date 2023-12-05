<?php

namespace App\Queues\Handlers;
interface QueueHandlerInterface
{
    public function handle($msg):void;
}
