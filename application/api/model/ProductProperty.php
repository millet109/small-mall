<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/22
 * Time: 13:46
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    /**
     * 模型内部隐藏
     * @var array
     */
    protected $hidden = [
        'delete_time',
        'img_id',
        'product_id',
    ];
}