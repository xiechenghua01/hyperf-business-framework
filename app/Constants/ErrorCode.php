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
namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("params.success")
     */
    public const SUCCESS = 200;

    /**
     * @Message("params.server_error")
     */
    public const SERVER_ERROR = 500;

    /**
     * @Message("params.index_title_error")
     */
    public const INDEX_TITLE_ERROR = 100001;
}
