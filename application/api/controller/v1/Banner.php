<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/9/13
 * Time: 18:06
 */
namespace app\api\controller\v1;

use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
class Banner
{
    /**
     * 获取指定ID的banner信息
     * @param $url /banner/:id
     * @param $id banner的ID号
     * @param $http get
     */
    public function getBanner($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $banner = BannerModel::getBannerById($id);
        //todo

    }
}