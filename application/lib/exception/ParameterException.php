<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/20
 * Time: 14:30
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}