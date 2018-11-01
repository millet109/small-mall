<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/11/1
 * Time: 14:10
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不允许';
    public $errorCode = 10001;
}