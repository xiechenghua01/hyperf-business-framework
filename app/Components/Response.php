<?php

/**
 * 自定义响应类
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/2/23 16:39
 */

declare(strict_types=1);

namespace App\Components;

use App\Constants\ErrorCode;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

class Response
{
    #[Inject]
    protected ResponseInterface $response;

    /**
     * 成功返回
     *
     * @param array $data 数据
     * @param int $code code
     * @param string|null $message 消息
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function success(array $data, int $code = 200, string $message = null): \Psr\Http\Message\ResponseInterface
    {
        if (is_null($message))
        {
            $message = ErrorCode::getMessage($code);
        }

        return $this->response->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * 失败返回
     *
     * @param int $code code
     * @param int $statusCode httpStatusCode
     * @param string|null $message 消息
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function fail(int $code, int $statusCode, string $message = null): \Psr\Http\Message\ResponseInterface
    {
        if ($code == 0)
        {
            $code = $statusCode;
        }

        if (is_null($message))
        {
            $message = ErrorCode::getMessage($code);
        }

        return $this->response->withStatus($statusCode)->json([
            'code' => $code,
            'message' => $message
        ]);
    }
}