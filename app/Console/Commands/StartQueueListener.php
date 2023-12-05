<?php

namespace App\Console\Commands;

use App\Queues\Queues;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class StartQueueListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-queue-listener {queue}';

    /**
     *
     * @var string
     */
    protected $description = 'Получает сообщения из очереди. Закается в супервизоре';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $queueName = $this->argument('queue');
        $rabbitMQService = new RabbitMQService();
        $rabbitMQService->consume(Queues::from($queueName));
    }
}
