<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Constants\ErrorCode;
use App\Log\Log;
use App\Middleware\RequestLogMiddleware;
use App\Request\IndexRequest;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Validation\Annotation\Scene;
#[Controller]
#[Middleware(RequestLogMiddleware::class)]
class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        throw new NotFoundHttpException();

        return $this->response->success([
            'method' => $method,
            'message' => "Hello {$user}.",
        ]);
    }

    /**
     * 测试接口
     *
     * @param IndexRequest $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[PostMapping('test', [])]
    #[Scene(scene: 'create')]
    public function test(IndexRequest $request): \Psr\Http\Message\ResponseInterface
    {
        // 获取请求数据
        $requestData = $request->all();
        sleep(1);

        Log::get('log')->info('info 测试啦');
        Log::get('log')->debug('debug 测试啦');
        Log::get('log')->error('error 测试啦');

        return $this->response->success($requestData);
    }
}
