<?php

/**
 * HTTP异常处理类
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/2/23 10:14
 */

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Components\Response;
use Hyperf\Contract\ContainerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpExceptionHandler extends \Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler
{
    /**
     * @var Response 自定义响应类
     */
    #[Inject]
    protected Response $response;

    /**
     * Handle the exception, and return the specified result.
     * @param HttpException $throwable
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->debug($this->formatter->format($throwable));

        // 阻止异常冒泡
        $this->stopPropagation();

        return $this->response->fail($throwable->getCode(), $throwable->getStatusCode(), $throwable->getMessage());

    }
}
