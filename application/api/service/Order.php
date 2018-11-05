<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/11/5
 * Time: 13:54
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    //订单的商品列表
    protected $oProducts;

    //数据库中取出的商品（库存量，价格等信息）
    protected $products;

    //用户ID
    protected $uid;

    /**
     * @param $uid
     * @param $oProducts
     */
    public function place($uid,$oProducts)
    {
        //$oProducts $products 作对比
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
    }

    /**
     * 通过用户传递的订单列表信息查询出数据库中该商品详细信息
     * @param $oProducts
     * @return mixed
     */
    private function getProductsByOrder($oProducts)
    {
        $oPIDs = [];
        foreach($oProducts as $item){
            array_push($oPIDs,$item['product_id']);
        }
        $products = Product::all($oPIDs)
            ->visible([
                'id','price','stock','name','main_img_url'
            ])
            ->toArray();
        return $products;
    }
}