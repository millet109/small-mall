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
use app\api\validate\IDMustBePositiveInt;
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

    /**
     * 通过分类ID获取分类下的商品
     * @url /by_category?id=3
     * @param $id
     * @return mixed
     * @throws ProductException
     */
    public function getAllInCategory($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }
}