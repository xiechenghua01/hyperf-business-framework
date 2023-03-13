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
    'handler' => [
        'http' => [
            // Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
            // HTTP异常处理
            \App\Exception\Handler\HttpExceptionHandler::class,
            // 表单验证器异常处理
            \App\Exception\Handler\ValidationExceptionHandler::class,
        ],
    ],
];
