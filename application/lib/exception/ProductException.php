<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/18
 * Time: 9:56
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '不存在最新商品，请检查参数';
    public $errorCode = 20000;
}