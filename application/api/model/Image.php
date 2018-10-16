<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/27
 * Time: 14:43
 */

namespace app\api\model;
use think\Model;

class Image extends Model
{
    /**
     * 模型内部隐藏/展示某些字段
     * @var array
     */
    protected $hidden = ['id','from','update_time','delete_time'];
    protected $visible = [];

    /**
     * 读取器拼接图片url完整路径
     * @param $value
     * @return string
     */
    public function getUrlAttr($value)
    {
        return config('setting.img_prefix').$value;
    }
}