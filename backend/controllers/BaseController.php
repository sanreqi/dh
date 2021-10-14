<?php

namespace backend\controllers;

use yii\base\Model;
use yii\web\Controller;

class BaseController extends Controller
{

    public $enableCsrfValidation = false;

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

    protected function errorAjax($errorMsg, $json_option = 0){
        $this->ajaxReturn(['status' => 0, 'errorMsg' => $errorMsg], $json_option);
    }

    protected function layerTableDataReturn($data, $count) {
        $returnData['code'] = 0;
        $returnData['msg'] = '';
        $returnData['count'] = $count;
        $returnData['data'] = $data;
        $this->ajaxReturn($returnData);
    }

    //@todo 不跳
    protected function error(){
        $this->redirect('/index/error');
        exit;
    }

    protected function checkIsAjax(){
        if (!Yii::$app->request->isAjax) {
            $this->error();
        }
    }

//    protected function getModelError(Model $model) {
//        if (empty($model->getFirstErrors())) {
//            return '';
//        }
//
//        $errors = array_values($model->getFirstErrors());
//        return $errors[0];
//    }



}