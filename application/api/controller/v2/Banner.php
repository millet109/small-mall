<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/13
 * Time: 18:06
 */
namespace app\api\controller\v2;

use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取指定ID的banner信息
     * @param $id
     * @return \think\response\Json
     * @throws BannerMissException
     */
    public function getBanner($id)
    {
        return "version-test:this is 2th version";

    }
}