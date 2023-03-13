<?php

/**
 * Index表单验证器
 *
 * @Group: WEB
 * @Author: 谢城华 xiechenghua01@163.com chenghua.xie@ehang.com
 * @Time: 2023/3/6 10:29
 */

declare(strict_types=1);

namespace App\Request;

use App\Constants\ErrorCode;
use Hyperf\HttpMessage\Exception\UnprocessableEntityHttpException;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'index_id' => 'required|integer|min:1',
            'index_title' => ['required', function ($attribute, $value, $fail)
            {
                if ($value != 'test')
                {
                    // $fail('The :attribute is invalid.');
                    throw new UnprocessableEntityHttpException(ErrorCode::getMessage(ErrorCode::INDEX_TITLE_ERROR, ['attribute' => trans('validation.attributes.'.$attribute)]), ErrorCode::INDEX_TITLE_ERROR);
                }
            }],
        ];
    }

    /**
     * The scenes defined by developer.
     */
    protected array $scenes = [
        // 新增
        'create' => ['index_title'],
        // 更新
        'update' => ['index_id', 'index_title'],
    ];
}
