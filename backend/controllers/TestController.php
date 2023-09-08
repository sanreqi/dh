<?php

namespace backend\controllers;
use common\models\User;
use Yii;
use yii\web\Controller;


class TestController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex() {
//        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
//        $r = Yii::$app->user->login($user,1000);

//        print_r(Yii::$app->user->identity);exit;
    }

    public function actionIndex2() {

//        print_r(Yii::$app->user->identity);exit;

//print_r(Yii::$app->getResponse()->getCookies());exit;
//        print_r(Yii::$app->getResponse()->getCookies()->get('_identity-backend'));
//        exit;
//        Yii::$app->getResponse()->set
//        print_r(Yii::$app->getResponse()->getCookies());exit;
        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
        $r = Yii::$app->user->login($user,1000);
        print_r($r);exit;
//        echo Yii::$app->user->identity->username;
        exit;
//echo 123; exit;
//        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
//        $r = Yii::$app->user->login($user);

        echo Yii::$app->user->identity->username;
        exit;
//        print_r($r);exit;

//        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);

    }

    public function actionCallback() {
        Yii::error('===callback===');
//        'wx' => [
//            'name' => '政务微信-uat',
//            'base_url' => 'zwwxuat.shdata.com/cgi-bin',
//            'corpid' => 'wwb9164107d1885dd1',
//            'corpsecret' => 'pdfw0nhtBgCls93R3TdO8r6Tp68KcH3ZPVa-0nDW53Y',
//            'token' => 'r23fn4iw0PZzfX537HAsGdnD',
//            'encodingAESKey' => 'MXWW3p35iovYtgfRJbNobaN1jiz3CRKNj8oxWWTcu9g',
//        ],

        $token = 'r23fn4iw0PZzfX537HAsGdnD';
        $corpId = 'wwb9164107d1885dd1';
        $encodingAesKey = 'MXWW3p35iovYtgfRJbNobaN1jiz3CRKNj8oxWWTcu9g';

        $this->receivePush();
        exit;
//        $agentId = '1000667';

        //接收get参数
        $request = Yii::$app->request;
        Yii::error('===callback-params==='.json_encode($request->get()));
        $sVerifyMsgSig = $request->get('msg_signature');
        $sVerifyNonce = $request->get('nonce');
        $sVerifyEchoStr = $request->get('echostr');
        $sVerifyTimeStamp = $request->get('timestamp');

        // 需要返回的明文
        $sEchoStr = "";

        $wxcpt = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
        if ($errCode == 0) {
            return $sEchoStr;
        } else {
            return "ERR: " . $errCode . "\n\n";
        }
    }

    public function receivePush()
    {
        $token = 'r23fn4iw0PZzfX537HAsGdnD';
        $corpId = 'wwb9164107d1885dd1';
        $encodingAesKey = 'MXWW3p35iovYtgfRJbNobaN1jiz3CRKNj8oxWWTcu9g';

        //接收get参数
        $request = Yii::$app->request;
        $sVerifyMsgSig = $request->get('msg_signature');
        $sVerifyNonce = $request->get('nonce');
        $sVerifyTimeStamp = $request->get('timestamp');

        //接收post数据包
        $sReqData = file_get_contents("php://input");

        $wxcpt = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);

        //密文解析
        $sMsg = "";  //用于存储解析之后的明文, sMsg是xml格式的明文
        $errCode = $wxcpt->DecryptMsg($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sReqData, $sMsg);

        if ($errCode != 0) {
            return "ERR: " . $errCode . "\n\n";
        }
        $wxData = $this->xmlToArray($sMsg);

        Yii::error('===receivepush-params==='.json_encode($wxData));
exit;

        //记录微信推送记录
        //$this->saveWxMsgLog($wxData);
        $this->sysLog['content']['wx_msg_data'] = $wxData;

        //消息类型
        $this->sysLog['des'] = $this->sysLog['des'] . '_' . $wxData['MsgType'];

        //接收事件
        if (isset($wxData['MsgType']) && $wxData['MsgType'] == 'event') {

            //事件类型
            $this->sysLog['des'] = $this->sysLog['des'] . '_' . $wxData['Event'];

            /*判断微信回调动作类型*/
            switch ($wxData['Event']) {
                //上报地理位置
                case 'LOCATION':
                    return $this->location($wxData);
                case 'enter_agent':
                    return $this->enterAgent($wxData);
                default:
                    return false;
            }
        }

        //接收普通消息
        if (isset($wxData['MsgType']) && in_array($wxData['MsgType'], ['text', 'image', 'voice', 'video', 'location', 'link'])) {
            return $this->message($wxData);
        }

    }
}