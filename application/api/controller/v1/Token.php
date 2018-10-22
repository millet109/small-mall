<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 13:45
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;
use app\api\service\UserToken;

class Token
{
    /**
     * 通过code从微信服务器获取token
     * @url /token/user
     * @param string $code
     * @return array
     */
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $wx = new UserToken($code);
        $token = $wx->get($code);
        return [
            'token' => $token
        ];
    }
}