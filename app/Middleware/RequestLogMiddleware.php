<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Log\Log;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestLogMiddleware implements MiddlewareInterface
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 请求开始时间
        $requestStartTime = (string)microtime(true);
        var_dump('请求接口-开始');
        $response = $handler->handle($request);

        // 请求结束时间
        $requestEndTime = (string)microtime(true);
        // 请求耗时, 单位/ms
        $takeTime = bcmul(bcsub($requestEndTime, $requestStartTime, 3), '1000');
        var_dump($takeTime);
        var_dump('请求接口--结束');

        // 记录日志
        Log::get('requestLog')->info('request: ' . json_encode($request->getParsedBody(), JSON_UNESCAPED_UNICODE) . ', response: ' . $response->getBody()->getContents());

        return $response;
    }
}
