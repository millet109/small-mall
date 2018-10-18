<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/16
 * Time: 15:35
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * 获取专题图片列表
     * @url /tmeme?ids=id1,id2,id3.....
     * @param string $ids
     * @return string 一组theme模型
     */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topicImg,headImg')->select($ids);
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return $result;
    }

    /**
     * 获取专题详情信息
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws ThemeException
     */
    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if($theme->isEmpty()){
            throw new ThemeException();
        }
        return $theme;
    }
}