<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Cache\Cache;
use Hyperf\Di\Annotation\Inject;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(exchange: 'ehang-hyperf', queue: 'ehang-hyperf', name: "DemoConsumer", nums: 2, enable: true)]
class DemoConsumer extends ConsumerMessage
{
    protected array|string $routingKey = ['ehang', 'ehang-hyperf'];

    /**
     * @var Cache
     */
    #[Inject]
    protected Cache $cache;

    public function consumeMessage($data, AMQPMessage $message): string
    {
        var_dump($message->getRoutingKey());
        // 缓存
        $this->cache->set("amqp:user:{$data['id']}", json_encode($data['data'], JSON_UNESCAPED_UNICODE), 600);

        return Result::ACK;
    }
}
