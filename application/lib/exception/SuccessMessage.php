<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/29
 * Time: 16:23
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;
}