<?php

declare(strict_types=1);

namespace App\Amqp\Producer;

use App\Model\User;
use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;

#[Producer(exchange: 'ehang-hyperf', routingKey: 'ehang')]
class DemoProducer extends ProducerMessage
{
    public function __construct($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $this->payload = [
            'id' => $id,
            'data' => $user->toArray()
        ];
    }
}
