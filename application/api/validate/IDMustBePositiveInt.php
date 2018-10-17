<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/14
 * Time: 10:33
 */
namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];
}