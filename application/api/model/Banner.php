<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/14
 * Time: 16:59
 */
namespace app\api\model;

use think\Db;
use think\Exception;

class Banner
{
    public static function getBannerByID($id)
    {
        $res = Db::query("select * from banner_item where banner_id=?",[$id]);
        return $res;
    }
}