<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/16
 * Time: 14:27
 */

namespace app\api\model;
use think\Model;

class BaseModel extends Model
{
    /**
     * 拼接图片url完整路径
     * @param $value
     * @param $data
     * @return string
     */
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}