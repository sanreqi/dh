<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\services\RbacService;
use yii\web\Controller;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $actionAuth = Yii::$app->params['action_auth'];
        $userWithoutAuth = $actionAuth['user_without_auth'];
        $guestOnly = $actionAuth['guest_only'];
        $allWithoutAuth = $actionAuth['all_without_auth'];
        $isGuest = Yii::$app->user->isGuest;
//        $path = Yii::$app->request->pathInfo;
        $path = Yii::$app->controller->module->id. '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;

        if($isGuest && !in_array($path, array_merge($guestOnly, $allWithoutAuth))) {
            //游客访问
            return Yii::$app->getResponse()->redirect('/site/login');
        }

        if (!$isGuest) {
            if (in_array($path, $guestOnly)) {
                //认证用户访问了游客才能访问的页面
                $this->goHome();
            }
            if (in_array($path, array_merge($userWithoutAuth, $allWithoutAuth))) {
                //认证用户访问了不需要验证的页面
                return true;
            }

            if (RbacService::checkPermission(Yii::$app->user->identity, $path)) {
                return true;
            } else {
                //beforeAction方法里抛出异常errorHandler不能正常使用,目前解决办法直接输出error页面
                echo $this->renderPartial('/site/error');
                exit;
            }
        }

        return true;
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data, $json_option=0) {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data,$json_option));
    }

    protected function successAjax($data = [], $status = 1, $json_option = 0){
        $returnData['data'] = $data;
        $returnData['status'] = $status;
        $this->ajaxReturn($returnData, $json_option);
    }

    protected function errorAjax($errorMsg, $json_option = 256){
        $this->ajaxReturn(['status' => 0, 'errorMsg' => $errorMsg], $json_option);
    }

    protected function successEchoAjax($data) {
        $data['status'] = 1;
        echo json_encode($data);
        exit;
    }

    protected function errorEchoAjax($errorMsg) {
        $data['status'] = 0;
        $data['errorMsg'] = $errorMsg;
        echo json_encode($data);
        exit;
    }

    protected function checkUid($uid) {
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::findIdentity($uid);
        if (empty($user)) {
            $this->errorAjax('非法请求');
        }
    }

}