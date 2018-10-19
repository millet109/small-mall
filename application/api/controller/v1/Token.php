<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 13:45
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
    }
}