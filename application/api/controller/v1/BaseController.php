<?php
/**
 * Created by PhpStorm.
 * User: 0375
 * Date: 2018/11/5
 * Time: 11:10
 */

namespace app\api\controller\v1;


use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{
    /**
     * 定义用户，管理员检查scope权限前置方法
     */
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    /**
     * 定义只有用户检查scope权限前置方法
     */
    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}