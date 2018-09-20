<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/17
 * Time: 11:49
 */

namespace app\lib\exception;


use think\Exception;
use Throwable;

class BaseException extends Exception
{
    //HTTP 状态码
    public $code = 400;

    //错误信息
    public $msg = '参数错误';

    //自定义错误码
    public $errorCode = 10000;

    public function __construct($params = [])
    {
        if(!is_array($params)){
            //throw new Exception('参数必须是数组');
            return;
        }

        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }

        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }

        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
    }

}