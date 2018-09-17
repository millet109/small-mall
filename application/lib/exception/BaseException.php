<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/17
 * Time: 11:49
 */

namespace app\lib\exception;


class BaseException
{
    //HTTP 状态码
    public $code = 400;

    //错误信息
    public $msg = '参数错误';

    //自定义错误码
    public $errorCode = 10000;
}