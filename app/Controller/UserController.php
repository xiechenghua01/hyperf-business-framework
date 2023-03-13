<?php

declare(strict_types=1);

namespace App\Controller;

use App\Middleware\RequestLogMiddleware;
use App\Model\User;
use App\Request\UserRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Annotation\Scene;

#[Controller]
#[Middlewares([RequestLogMiddleware::class])]
class UserController extends AbstractController
{
    /**
     * 用户列表
     *
     * @param RequestInterface $request
     * @param User $user
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[GetMapping]
    public function index(RequestInterface $request, User $user)
    {
        // 获取请求数据
        $requestData = $request->all();
        // 数据列表
        $user = $user->usersList($requestData)->toArray();

        return $this->response->success($user);
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

    /**
     * 用户详情
     *
     * @param RequestInterface $request
     * @param User $user
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[GetMapping]
    public function read(RequestInterface $request, User $user): \Psr\Http\Message\ResponseInterface
    {
        // 获取请求数据
        $requestData = $request->all();
        // 查询数据
        $user = $user->getUser((int)$requestData['id'])->toArray();

        return $this->response->success($user);
    }

    /**
     * 删除用户
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[DeleteMapping]
    #[Scene(scene: 'delete')]
    public function delete(UserRequest $request, User $user): \Psr\Http\Message\ResponseInterface
    {
        // 获取请求数据
        $requestData = $request->all();
        // 删除数据
        $user->deleteUser((int)$requestData['id']);

        return $this->response->success([]);
    }
}
