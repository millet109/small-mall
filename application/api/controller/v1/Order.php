<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/11/1
 * Time: 17:40
 */

namespace app\api\controller\v1;


use app\api\validate\OrderPlace;

class Order extends BaseController
{
    protected $beforeActionList  = [
        'checkExclusiveScope' => ['only'=>'placeOrder'],
    ];

    //用户点击商品，展示商品信息
    //库存量检测（避免下单时被其他用户买走最后一个，无库存，实时更新并不能完全解决该问题，检测库存必须）
    //有库存，订单数据写入数据，下单成功返回给用户可支付信息
    //调用支付接口，进行支付
    //库存量检测：支付同时还需要进行库存检测，因为目前下单后一般有一个支付缓冲期，该时间段商品可能销售完
    //然后检测好调用支付接口
    //微信返回支付结果（异步执行）
    //库存量检测：即时此时返回成功也需要再次进行库存量检测
    //成功减库存，失败，返回支付失败结果


    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
    }
}