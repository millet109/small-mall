<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/16
 * Time: 15:38
 */

namespace app\api\model;


class Theme extends BaseModel
{
    /**
     * 模型内部隐藏/展示某些字段
     * @var array
     */
    protected $hidden = [
        'update_time',
        'delete_time',
        'topic_img_id',
        'head_img_id'
    ];
    protected $visible = [];

    /**
     *获取专题top图片
     * @return \think\model\relation\BelongsTo
     */
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    /**
     * 获取专题点击进去的head图片
     * @return \think\model\relation\BelongsTo
     */
    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }

    /**
     * 通过关联表关联获取products信息
     * @return \think\model\relation\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    /**
     * 获取theme和produsts信息
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getThemeWithProducts($id)
    {
        return $theme = self::with('products,topicImg,headImg')->find($id);
    }
}