<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/14
 * Time: 11:28
 */
namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $result = $this->batch()->check($params);
        //if(!$this->check($params)){
        if(!$result){
            $exception = new ParameterException([
                //'msg' => is_array($this->error) ? implode(
                    //';', $this->error) : $this->error,
                'msg' => $this->error,
            ]);
            throw $exception;
        }
        return true;
    }

    /**
     * 验证参数是否为正整数
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     */
    protected function isPositiveInteger($value,$rule = '',$data = '',$field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * 雅正获取token的code是否为空
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool
     */
    protected function isNotEmpty($value,$rule = '',$data = '',$field = '')
    {
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 手机号验证规则
     * @param $value
     * @return bool
     */
    public function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 通过Rule过滤获取用户传递的参数
     * @param $arrays
     * @return array
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if(array_key_exists('user_id',$arrays) || array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg' => '参数中包含有非法参数user_id或uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}