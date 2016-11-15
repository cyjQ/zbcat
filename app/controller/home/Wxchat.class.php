<?php
class Wxchat extends CModel {
    protected $textTpl= "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
    protected $wx;
    public function __construct(){
        parent::__construct();
        $this->wx = Wchat::getIns(C('appid'),C('secret'));
    }

    public function checkSignature(){
        $this->responseMsg();
    }

    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            if(!empty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "欢迎来到财务管家!";
                $resultStr = sprintf($this->textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }

        }else {
            echo "";
            exit;
        }
    }

    /*
     * 创建自定义菜单
     */
    public function createMenu(){
        if($this->wx->creteMenu()){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    /*
     * 获取微信服务器ip
     */
    public function getIpList(){
        return $this->wx->getWxIp();
    }

}