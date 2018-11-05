<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/11/5
 * Time: 11:27
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    //加入需要验证如下结构数据，比较复杂，分析如何编写验证器
//    protected $products = [
//        [
//            'product_id' =>1,//正整数
//            'count' => 3,//正整数
//        ],
//        [
//            'product_id' =>2,
//            'count' => 4,
//        ],
//        [
//            'product_id' =>5,
//            'count' => 7,
//        ],
//    ];

    protected $rule = [
        'products' => 'checkProducts',
    ];

    /**
     * 自定义，Validate不能自己调用
     * @var array
     */
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger',
    ];

    //因为checkProducts使用场景比较唯一，所以不需要在Base中编写
    /**
     * 对下单的商品进行校验
     * @param $values
     * @return bool
     * @throws ParameterException
     */
    protected function checkProducts($values)
    {
        if(is_array($values)){
            throw new ParameterException([
                'msg' => '商品参数不正确'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }

        foreach ($values as $value){
            $this->checkProduct($value);
        }
        return true;
    }

    /**
     * 对下单商品中的每一项商品进行校验
     * @param $value
     * @throws ParameterException
     */
    protected function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}