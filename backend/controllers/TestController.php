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

        if (!isset($_GET['echostr'])) {
            $this->receivePush();
            exit;
        }
        $agentId = '1000667';

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

    public function xmlToArray($xml){
        $xml = simplexml_load_string($xml,NULL,LIBXML_NOCDATA);
        return  json_decode(json_encode($xml),true);
    }

    public function createNonceStr($length=16) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i=0; $i<$length; $i++) {
            $str .= substr($chars,mt_rand(0,strlen($chars)-1),1);
        }
        return $str;
    }

    public function actionZh() {
     $r = md5('/12312321');
     $t = substr($r,0,1);
     echo $t; exit;
     echo $r;exit;
        $this->layout = false;
        $ticket = $this->getJsapi();
//print_r($ticket);exit;
        $nonceStr = $this->createNonceStr();
        $timestamp = time();
        $corpId = 'wwb9164107d1885dd1';
        $url = 'http://dhadmin.xiaosanjun.com/test/zh';

        $string1 = "jsapi_ticket={$ticket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
        $signature = sha1($string1);
        $data = [
            'appId' => $corpId,
            'nonceStr' => $nonceStr,
            'timestamp' => $timestamp,
            'url' => $url,
            'signature' => $signature,
            'jsApiList' => [
                'chooseWXPay'
            ],
        ];

//        $str = 'jsapi_ticket=sM4AOVdWfPE4DxkXGEs8VMCPGGVi4C3VM0P37wVUCFvkVAy_90u5h9nbSlYy3-Sl-HhTdfl2fzFy1AOcHKP7qg&noncestr=Wm3WZYTPz0wzccnW&timestamp=1414587457&url=http://mp.weixin.qq.com';
//        $r = sha1($str,true);
//        echo $r;exit;

        return $this->render('zh',$data);



        print_r($signature);exit;


        echo $this->getJsapi();
        exit;
        echo 666666;
        exit;
    }

    protected function request($url, $method = "get", $body = []) {
        $method = strtolower($method);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if ($method == 'post') {
            if (is_array($body)) {
                $body = json_encode($body);
            }
            curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

            curl_setopt($curl, CURLOPT_HEADER, 0);
            $header = [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($body)
            ];
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function getAccessToken() {
        $key = 'zw_access_token';
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        if ($redis->get($key)) {
            //return $redis->get($key);
        }

        $url = 'http://zwwxuat.shdata.com/cgi-bin/gettoken?corpid=wwb9164107d1885dd1&corpsecret=d4FZ67U6je9yJq3_YwdMVcor_7Gv_lWTXoOj9YnnpLU';

        $response = $this->request($url);
        $response = json_decode($response,true);
        $accessToken = $response['access_token'];
        $redis->set($key,$accessToken,7100);
        return $accessToken;
    }

    public function getJsapi() {
        $key = 'zw_jsapi';
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
//print_r($redis->get($key));exit;
        if ($redis->get($key)) {
//            return $redis->get($key);
        }
        $accessToken = $this->getAccessToken();
        $url = 'http://zwwxuat.shdata.com/cgi-bin/get_jsapi_ticket?access_token='.$accessToken;
//echo $url;exit;
        $response = $this->request($url);
        $response = json_decode($response,true);
//print_r($response);exit;
        if (!isset($response['ticket'])) {
            return '';
        }
        $ticket = $response['ticket'];
        $redis->set($key,$ticket,7100);
        return $ticket;
    }

    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            print $e . "\n";
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }
}
