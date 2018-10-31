<?php

/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 13:58
 */

namespace app\api\service;

use app\lib\exception\TokenException;
use app\lib\exception\WechatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    /**
     * UserToken constructor.
     * @param $code
     */
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    /**
     * 获取session_key及openID
     * @param $code
     * @return mixed
     * @throws Exception
     */
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception("获取session_key及openID时异常，微信内部错误");
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }

    /**
     * 异常处理
     * @param $wxResult
     * @throws WechatException
     */
    private function processLoginError($wxResult)
    {
        throw new WechatException([
            'msg' => '获取session_key及openID时异常，微信内部错误',
            'errorCode' => $wxResult['errcode']
        ]);
    }

    /**
     * 颁发令牌Token
     * @param $wxResult
     * @return string
     */
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }else{
           $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCacheValue($wxResult,$uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    /**
     * 将新用户插入数据库
     * @param $openid
     * @return mixed
     */
    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);

        return $user->id;
    }

    /**
     * 准备缓存信息
     * @param $wxResult
     * @param $uid
     * @return mixed
     */
    private function prepareCacheValue($wxResult,$uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
        return $cacheValue;
    }

    /**
     * 将缓存信息写入缓存
     * @param $cachedValue
     * @return string
     * @throws TokenException
     */
    private function saveToCache($cachedValue)
    {
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $ecpire_in = config('setting.token_expire_in');

        $request = cache($key,$value,$ecpire_in);
        if(!$request){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errcode' => 10005
            ]);
        }
        return $key;
    }
}