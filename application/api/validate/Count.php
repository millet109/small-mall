<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/18
 * Time: 9:39
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}