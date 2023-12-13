<?php


namespace common\services;


use common\models\Contact;

class WxCallbackService
{

    public function __construct()
    {
        $this->tokenMsg = 'weixin';
    }

    public function response()
    {
        if (!$this->checkSignature()) {
            return 'sign error';
        }
        if (isset($_GET['echostr'])) {
            return $_GET['echostr'];
        } else {
            return $this->responseMsg();
        }
    }

    /**
     * 消息回复主程序
     * 返回信息
     */
    private function responseMsg()
    {
        $postStr = file_get_contents("php://input");

        $model = new Contact();
        $model->contact = '====callback_postObj===='.json_encode($postObj);
        $model->save();

        if (empty($postStr) || !is_string($postStr)) {
            return 'empty';
        }
        libxml_disable_entity_loader(true);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $model = new Contact();
        $model->contact = '====callback_postObj===='.json_encode($postObj);
        $model->save();
        $RX_TYPE = trim($postObj->MsgType);
        switch ($RX_TYPE) {
            case 'text':
                $resultStr = $this->handleText($postObj);
                break;
            case 'event':
                $resultStr = $this->handleEvent($postObj);
                break;
            default:
                $resultStr = 'Unknow msg type:' . $RX_TYPE;
                break;
        }
        return $resultStr;
    }

    private function handleText($postObj)
    {
        $keyword = trim($postObj->Content);
        $contentStr = "可以回复";
        return $this->responseText($postObj, $contentStr);

    }

    private function handleEvent($object)
    {
        $contentStr = '';
        switch ($object->Event) {
            case 'subscribe':
                $contentStr = "感谢您的关注！";
                return $this->responseText($object, $contentStr);
                break;
            case 'CLICK':
                return $this->responClick($object);
                break;
            default:
                return $this->responseText($object, "Unknow Event" . $object->Event);
        }

    }

    private function responClick($object)
    {
    }


    /**
     * 回复文本模板
     */
    private function responseText($object, $content, $flag = 0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        return sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
    }

    /**
     * 回复图文模板
     */
    private function responseTextImg($object, $title, $description, $picurl, $url)
    {
        $tpl = "<xml>
                 <ToUserName><![CDATA[%s]]></ToUserName>
                 <FromUserName><![CDATA[%s]]></FromUserName>
                 <CreateTime>%s</CreateTime>
                 <MsgType><![CDATA[news]]></MsgType>
                 <ArticleCount>1</ArticleCount>
                 <Articles>
                 <item>
                 <Title><![CDATA[%s]]></Title> 
                 <Description><![CDATA[%s]]></Description>
                 <PicUrl><![CDATA[%s]]></PicUrl>
                 <Url><![CDATA[%s]]></Url>
                 </item>
                 </Articles>
             </xml>";

        return sprintf($tpl, $object->FromUserName, $object->ToUserName, time(), $title, $description, $picurl, $url);
    }

    /**
     * 回复图片
     */
    private function responseImg($object, $MediaId)
    {
        $tpl = "<xml>
                <ToUserName>< ![CDATA[%s] ]></ToUserName>
                <FromUserName>< ![CDATA[%s] ]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType>< ![CDATA[image] ]></MsgType>
                <Image><MediaId>< ![CDATA[%s] ]></MediaId></Image>
                <FuncFlag>0</FuncFlag>
                </xml>";

        $str = sprintf($tpl, $object->FromUserName, $object->ToUserName, time(), $MediaId);
        return $str;
    }

    /**
     * 校验签名
     */
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = [$this->tokenMsg, $timestamp, $nonce];
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}
