<?php

/**
 * 自定义表单验证事件监听器
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/3/6 10:30
 */

declare(strict_types=1);

namespace App\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\Event\ValidatorFactoryResolved;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class ValidatorFactoryResolvedListener implements ListenerInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function listen(): array
    {
        return [
            ValidatorFactoryResolved::class,
        ];
    }

    public function process(object $event): void
    {
        /**
         * @var ValidatorFactoryInterface $validatorFactory
         */
        $validatorFactory = $event->validatorFactory;

        // 注册 checkTitle 验证器
        $validatorFactory->extend('check_index_title', function ($attribute, $value, $parameters, $validator)
        {
            var_dump($attribute, $value, $parameters);
            // 验证规则
            return $value == 'test';
            return true;
        });
        $validatorFactory->replacer('check_index_title', function ($message, $attribute, $rule, $parameters)
        {
            return str_replace(':attribute', $attribute, $message);
        });
    }
}
