<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/17
 * Time: 13:52
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}