<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/17
 * Time: 11:18
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分隔的多个正整数'
    ];

    /**
     * 验证ids参数是否是以逗号分隔的多个正整数
     * @param $value
     * @return bool
     */
    protected function checkIDs($value)
    {
        $values = explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
            if (!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}