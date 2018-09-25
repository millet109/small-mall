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
        }
        return $field . '必须是正整数';
    }
}