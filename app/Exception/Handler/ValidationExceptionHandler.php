<?php

/**
 * 表单验证异常处理类
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/3/3 14:54
 */

declare(strict_types=1);

namespace App\Exception\Handler;

use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use App\Components\Response;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    /**
     * @var Response 自定义响应类
     */
    #[Inject]
    protected Response $response;

    /**
     * @param Throwable $throwable
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 阻止异常冒泡
        $this->stopPropagation();

        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = $throwable->validator->errors()->first();

        return $this->response->fail($throwable->status, $throwable->status, $body);
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
