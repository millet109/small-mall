<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/14
 * Time: 11:28
 */
namespace app\api\validate;

use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        if(!$this->check($params)){
            $exception = new ParameterException([
                'msg' => is_array($this->error) ? implode(
                    ';', $this->error) : $this->error,
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
    projected function isPositiveInteger($value,$rule = '',$data = '',$field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return $field . '必须是正整数';
    }
}