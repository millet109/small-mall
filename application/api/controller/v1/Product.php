<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/18
 * Time: 9:36
 */

namespace app\api\controller\v1;

use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product
{
    /**
     * 获取最新商品
     * @url /recent?count=15
     * @param int $count 最新商品数量
     * @return false|\PDOStatement|string|\think\Collection
     * @throws ProductException
     */
    public function getRecent($count=15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }
}