<?php

declare(strict_types=1);

namespace App\Command;

use App\Amqp\Producer\DemoProducer;
use App\Model\User;
use Hyperf\Amqp\Producer;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;

#[Command]
class DemoCommand extends HyperfCommand
{
    /**
     * 注入生产者
     *
     * @var Producer
     */
    #[Inject]
    protected Producer $producer;

    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('demo:command');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $this->line('启动生产机器...', 'info');
        $this->line('正在生产...', 'info');

        User::select('id')->chunk(100, function ($data)
        {
            foreach ($data->toArray() as $item)
            {
                // 生产消息
                $message = new DemoProducer($item['id']);
                // 投递消息
                $result = $this->producer->produce($message);
            }
        });

        $this->line('当前任务已生产完成, 关闭生产机器...', 'info');
    }
}
