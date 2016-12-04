<?php
class Wchat{
    protected $appid;
    protected $secret;
    public static $ins = null;
    protected function ini($appid,$secret){
        $this->appid = $appid;
        $this->secret = $secret;
    }

    protected function __construct($appid,$secret){
        $this->ini($appid,$secret);
    }

    public static function getIns($appid,$secret){
        if(self::$ins === null){
            self::$ins = new self($appid,$secret);
        }
        return self::$ins;

    }

    /*
     * 获取公众号的token
     */
    protected function getAccessToken(){
        $wx_conf = D('wx_conf',1);
        $res = $wx_conf->select();
        if(count($res) <1 || ($res[0]['create_time']) < time()){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->secret;
            $access_token =  file_get_contents($url);
            $accessTokeData = json_decode($access_token);
            $data['create_time'] = $accessTokeData->expires_in+time();
            $data['access_token'] = $accessTokeData->access_token;
            if(count($res) <1){
                $wx_conf->add($data);
            }else if(($res[0]['create_time']) < time()){
                $wx_conf->where(array('id'=>$res[0]['id']))->save($data);
            }
            return $access_token;
        }else{
            return $res[0]['access_token'];
        }
    }

    /*
     * 获取微信回调服务器ip
     */
    public function getWxIp(){
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$this->getAccessToken();
        $ipList = file_get_contents($url);
        $ipList = json_decode($ipList);
        if($ipList->errcode){
            if($ipList->errcode == 40001){
                errlog($ipList->errcode.':'.$ipList->errmsg);
                $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$this->getAccessToken();
                $ipList = json_decode(file_get_contents($url));
                if($ipList->errcode){
                    errlog($ipList->errcode.':'.$ipList->errmsg);
                }
            }
            errlog($ipList->errcode.':'.$ipList->errmsg);
        }
        return $ipList->ip_list;
    }

    /*
     * 创建自定义菜单
     */
    public function creteMenu(){
        $menuData = jsEcode(C('menu'));
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getAccessToken();
        echo $url;
        $resut = json_decode(https_request($url,$menuData));
        //var_dump(json_decode($resut));
        if($resut->errcode>0){
            errlog('createMenu Error:'.$resut->errmsg);
            return false;
        }
        return true;
    }

    /*
     * 微信开发者认证
     */
    public function checkSignature(){
        // you must define TOKEN by yourself
        define("TOKEN", C('token'));
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function getJsTicket(){
        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=wx_card";
        $res = https_request($url);
        if($res){
            return $res;
        }
        return false;
    }

    /*
     * 获取js-sdk配置
     */

    function getJssdkConfig(){
        $url = I('url','','trim');
        Validator::validate(array(
            array($url,array('require','url'),'参数错误')
        ));
        if(Validator::getIns()->getError()['code'] != 0){
            jsOutput(Validator::getIns()->getError());
            errlog(__FUNCTION__.'Error:'.'this param url is need ,empty give');
        }
        $conf['appid'] = C('appid');
        $conf['secret'] = C('secret');
        $conf['timestamp'] = time();
        $js_ticket = $this->getJsTicket();
        $ticket = json_decode($js_ticket);
        var_dump($ticket);

    }



}
?>