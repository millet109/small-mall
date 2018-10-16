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
     *获取专题top图片
     * @return \think\model\relation\BelongsTo
     */
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    /**
     * 虎丘专题点击进去的head图片
     * @return \think\model\relation\BelongsTo
     */
    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }
}