<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/29
 * Time: 16:02
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}