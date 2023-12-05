<?php

namespace App\Services;

use App\Queues\Queues;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    public function publish(string $message, string $exchange, string $key = ''): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();

        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, $exchange, $key);
        $channel->close();
        $connection->close();
    }
    public function consume(Queues $queue): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $callback = function ($msg) use ($queue) {
            $queue->getHandler()->handle($msg);
        };
//        $channel->queue_declare($queue->value, false, true, false, false);
        $channel->basic_consume($queue->value, '', false, true, false, false, $callback);

        // Loop as long as the channel has callbacks registered
        while ($channel ->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}
