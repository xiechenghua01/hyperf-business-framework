<?php

/**
 * 自定义日志类
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/3/8 11:19
 */

declare(strict_types=1);

namespace App\Log;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class Log
{
    /**
     * 获取 channel
     *
     * @param string $name
     * @param string $group
     * @return \Psr\Log\LoggerInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function get(string $name = 'log', string $group = 'default'): \Psr\Log\LoggerInterface
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name, $group);
    }
}