<?php

declare(strict_types=1);

namespace App\Controller;

use App\Middleware\RequestLogMiddleware;
use App\Model\User;
use App\Request\UserRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Annotation\Scene;

#[Controller]
#[Middlewares([RequestLogMiddleware::class])]
class UserController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    /**
     * 新增用户
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[PostMapping]
    #[Scene(scene: 'create')]
    public function save(UserRequest $request, User $user): \Psr\Http\Message\ResponseInterface
    {
        // 获取请求数据
        $requestData = $request->all();
        // 新增数据
        $user = $user->saveUser($requestData)->toArray();

        return $this->response->success($user);
    }
}
