<?php

/**
 * 全局中间件
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/02/24 16:37
 */

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Contract\TranslatorInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GlobalMiddleware implements MiddlewareInterface
{
    #[Inject]
    protected TranslatorInterface $translator;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 获取请求Header中的Lang
        if ($lang = $request->getHeaderLine('lang'))
        {
            // 设置语言
            $this->translator->setLocale($lang);
        }

        return $handler->handle($request);
    }
}
