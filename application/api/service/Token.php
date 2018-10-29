<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 16:17
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Exception;
use think\Request;
use think\Cache;

class Token
{
    /**
     * 生成Token
     * @return string
     */
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }

    /**
     * 通过token获取缓存中的用户缓存数据
     * @param $key
     * @return mixed
     * @throws Exception
     * @throws TokenException
     */
    public static function getCurrentTokenVar($key)
    {
        //从header头中获取token
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('尝试获取的Token变量不存在');
            }
        }
    }

    /**
     * 获取uid
     * @return mixed
     */
    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}