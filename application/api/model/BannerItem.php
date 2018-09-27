<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/27
 * Time: 11:17
 */

namespace app\api\model;
use think\Model;

class BannerItem extends Model
{
    /**
     * 获取image表中banner图片url信息
     * @return \think\model\relation\BelongsTo
     */
    public function img()
    {
        //需要从哪一边访问另外一边就在哪边定义关联关系，所以这个在banner_item模型定义。而不在image模型定义
        return $this->belongsTo('Image','img_id','id');
    }
}