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
return [
    'http' => [
        // 全局中间件
        \App\Middleware\GlobalMiddleware::class,
        // 跨域中间件
        \App\Middleware\CorsMiddleware::class,
        // 表单验证器中间件
        \Hyperf\Validation\Middleware\ValidationMiddleware::class,
    ],
];
