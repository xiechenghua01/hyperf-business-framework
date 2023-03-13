<?php

declare(strict_types=1);

namespace App\Request;

use App\Model\User;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'gender' => [Rule::in(User::GENDERS)],
            'birthday' => 'date',
            'department_id' => 'required|integer|min:1'
        ];
    }

    /**
     * The scenes defined by developer.
     */
    protected array $scenes = [
        // 新增
        'create' => ['name', 'email', 'gender', 'birthday', 'department_id'],
        // 更新
        'update' => [],
    ];
}
