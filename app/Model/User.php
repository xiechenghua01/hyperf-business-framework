<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\ModelCache\Cacheable;

/**
 * @property int $id 
 * @property string $name 用户名
 * @property string $email 邮箱
 * @property int $gender 性别: 1-保密, 2-男, 3-女
 * @property string $birthday 生日
 * @property int $department_id 所属部门id
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class User extends Model
{
    use SoftDeletes;
    use Cacheable;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'name', 'email', 'gender', 'birthday', 'department_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'gender' => 'integer', 'department_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    // 性别-未知
    protected const GENDER_UNKNOWN  = 1;
    // 性别-男
    protected const GENDER_MAN      = 2;
    // 性别-女
    protected const GENDER_WOMAN    = 3;

    public const GENDERS = [self::GENDER_UNKNOWN, self::GENDER_MAN, self::GENDER_WOMAN];

    /**
     * 用户列表
     *
     * @param array $queryData
     * @return \Hyperf\Contract\LengthAwarePaginatorInterface
     */
    public function usersList(array $queryData): \Hyperf\Contract\LengthAwarePaginatorInterface
    {
        return self::orderBy('id')
            ->paginate((int)@$queryData['per_page'] ?: 10, ['*'], 'users', (int)@$queryData['page'] ?: 1);
    }

    /**
     * 新增用户
     *
     * @param array $queryData
     * @return User|\Hyperf\Database\Model\Model
     */
    public function saveUser(array $queryData): User|\Hyperf\Database\Model\Model
    {
        return self::create($queryData);
    }

    /**
     * 用户详情
     *
     * @param int $id
     * @return \Hyperf\Database\Model\Model|\Hyperf\Database\Model\Builder|null
     */
    public function getUser(int $id): \Hyperf\Database\Model\Model|\Hyperf\Database\Model\Builder|null
    {
        return self::findFromCache($id);
        // return self::where('id', $id)->first();
    }


    public function updateUser(array $queryData)
    {
        // 加载当前用户
        $user = self::findOrFail($queryData['id']);
        $user->fill($queryData)->save();
        return $user;
    }

    /**
     * 删除用户
     *
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id): void
    {
        self::destroy($id);
    }
}
