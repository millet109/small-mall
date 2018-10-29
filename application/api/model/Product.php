<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/16
 * Time: 15:37
 */

namespace app\api\model;

class Product extends BaseModel
{
    /**
     * 模型内部隐藏
     * @var array
     */
    protected $hidden = [
        'delete_time',
        'update_time',
        'create_time',
        'main_img_id',
        'pivot',
        'from',
        'category_id',
    ];

    /**
     * 通过获取器拼接main_img_url完整路径
     * @param $value
     * @param $data
     * @return string
     */
    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage','product_id','id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty','product_id','id');
    }

    /**
     * 获取最新商品
     * @param $count
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    /**
     * 通过分类ID获取该分类下的商品
     * @param $categoryID
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::where('category_id','=',$categoryID)
            ->select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        $product = self::with('imgs,properties')
            ->find($id);
        return $product;
    }
}