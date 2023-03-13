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
$appEnv = env('APP_ENV', 'dev');
$driver = env('LOG_DRIVER', 'file');
// 处理器
$handlers = [];
if ($driver == 'file')
{
    $handlers = [
        // info, waring, notice 日志等
        [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/hyperf.log',
                'maxFiles' => 10,
                'level' => Monolog\Logger::INFO,
            ],
            'formatter' => [
                'class' => Monolog\Formatter\LineFormatter::class,
                'constructor' => [
                    'format' => null,
                    'dateFormat' => 'Y-m-d H:i:s',
                    'allowInlineLineBreaks' => true,
                    'ignoreEmptyContextAndExtra' => true,
                ],
            ],
        ],
        // debug 日志
        [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/hyperf-debug.log',
                'maxFiles' => 10,
                'level' => Monolog\Logger::DEBUG,
            ],
            'formatter' => [
                'class' => Monolog\Formatter\LineFormatter::class,
                'constructor' => [
                    'format' => null,
                    'dateFormat' => 'Y-m-d H:i:s',
                    'allowInlineLineBreaks' => true,
                    'ignoreEmptyContextAndExtra' => true,
                ],
            ],
        ],
        // error 日志
        [
            'class' => Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/hyperf-error.log',
                'maxFiles' => 10,
                'level' => Monolog\Logger::ERROR,
            ],
        ]
    ];
}

// 格式化
if ($appEnv == 'dev')
{
    $formatter = [
        'class' => Monolog\Formatter\LineFormatter::class,
        'constructor' => [
            'format' => null,
            'dateFormat' => 'Y-m-d H:i:s',
            'allowInlineLineBreaks' => true,
        ],
    ];
} else
{
    $formatter = [
        'class' => \Monolog\Formatter\JsonFormatter::class,
        'constructor' => [],
    ];
}

return [
    'default' => [
        'handlers' => $handlers,
        'formatter' => $formatter,
    ],
];
