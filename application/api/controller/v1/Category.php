<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/10/18
 * Time: 14:29
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    /**
     * 获取所有的分类列表
     * @url /category/all
     * @return false|static[]
     * @throws CategoryException
     */
    public function getAllCategory()
    {
        $categorys = CategoryModel::all([],'img');
        if($categorys->isEmpty()){
            throw new CategoryException();
        }
        return $categorys;
    }
}