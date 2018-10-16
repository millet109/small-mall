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
     * @param $value 目标字段值 url
     * @param $data 查询数组 包含url，from
     * @return string
     */
    public function getUrlAttr($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}