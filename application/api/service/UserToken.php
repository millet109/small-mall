<?php

/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/19
 * Time: 13:58
 */

namespace app\api\service;

use app\lib\exception\WechatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken
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
    public function get($code)
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
                $this->grantToken($wxResult);
            }
        }
        return $wxResult;
    }

    private function processLoginError($wxResult)
    {
        throw new WechatException([
            'msg' => '获取session_key及openID时异常，微信内部错误',
            'errorCode' => $wxResult['errcode']
        ]);
    }

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
    }

    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);

        return $user->id;
    }

    private function prepareCacheValue($wxResult,$uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
    }

    private function saveToCache($cachedValue)
    {
        $key = generateToken();
    }
}