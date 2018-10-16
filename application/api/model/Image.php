<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/27
 * Time: 14:43
 */

namespace app\api\model;

class Image extends BaseModel
{
    /**
     * 模型内部隐藏/展示某些字段
     * @var array
     */
    protected $hidden = ['id','from','update_time','delete_time'];
    protected $visible = [];

    /**
     * 继承调用基类模型获取器方法进行imgUrl拼接
     * @param $value 目标字段值 url
     * @param $data 查询数组 包含url，from
     * @return string
     */
    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }
}