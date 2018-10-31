<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/31
 * Time: 14:45
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = [
        'id',
        'delete_time',
        'user_id'
    ];
}