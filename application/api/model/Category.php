<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/18
 * Time: 14:29
 */

namespace app\api\model;


class Category extends BaseModel
{
    /**
     * 模型内部隐藏
     * @var array
     */
    protected $hidden = [
        'update_time',
        'delete_time'
    ];

    /**
     * 拼接topic_img图片路径
     * @return \think\model\relation\BelongsTo
     */
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }
}