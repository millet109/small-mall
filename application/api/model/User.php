<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 13:56
 */

namespace app\api\model;


class User extends BaseModel
{
    /**
     * 查询用户地址信息
     * @return \think\model\relation\HasOne
     */
    public static function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    /**
     * 通过openid获取用户信息
     * @param $openid
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('openid','=',$openid)
            ->find();
        return $user;
    }
}