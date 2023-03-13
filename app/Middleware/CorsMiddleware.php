<?php

/**
 * 跨域中间件
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/02/23 10:46
 */

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Context\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 获取上下文
        $response = Context::get(ResponseInterface::class);
        // 更改数据
        $response = $response->withAddedHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            // Headers 可以根据实际情况进行改写。
            ->withHeader('Access-Control-Allow-Headers', 'DNT,Keep-Alive,User-Agent,Cache-Control,Content-Type,Authorization');
        // 将更改的数据重新写入上下文
        Context::set(ResponseInterface::class, $response);

        if ($request->getMethod() == 'OPTIONS')
        {
            return $response;
        }

        return $handler->handle($request);
    }
}
