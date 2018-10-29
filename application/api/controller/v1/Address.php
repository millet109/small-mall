<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/29
 * Time: 13:57
 */

namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
class Address
{
    public function createOrUpdateAddress()
    {
        (new AddressNew())->goCheck();
        //根据token获取uid
        //根据uid获取用户数据，判断用户是否存在，不存在抛出异常
        //存在，获取用户从客户端提交过来的地址信息
        $uid = TokenService::getCurrentUid();
    }
}