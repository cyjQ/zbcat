<?php
class Wchat{
    protected $appid;
    protected $secret;
    public static $ins = null;
    protected function ini(){
        $this->appid = C('appid');
        $this->secret = C('secret');
    }

    protected function __construct(){
        $this->ini();
    }

    public static function getIns(){
        if(self::$ins === null){
            self::$ins = new self();
        }
        return self::$ins;

    }

    /*
     * 获取公众号的token
     */
    public function getAccessToken(){
        $wx_conf = D('wx_conf',1);
        $res = $wx_conf->where(array('conf_colum'=>'access_token'))->select();
        if(count($res) <1 || ($res[0]['create_time']) < time()){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->secret;
            $access_token =  file_get_contents($url);
            $accessTokeData = json_decode($access_token);
            $data['create_time'] = ($accessTokeData->expires_in+time()-5);
            $data['access_token'] = $accessTokeData->access_token;
            $data['conf_colum'] = 'access_token';
            if(count($res) <1){
                $wx_conf->add($data);
            }else if(($res[0]['create_time']) < time()){
                $wx_conf->where(array('conf_colum'=>'access_token'))->save($data);
            }
            return $data['access_token'];
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
                errlog(__FUNCTION__.' error:' .$ipList->errcode.':'.$ipList->errmsg.' '.__FILE__.'on '.__LINE__);
                $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$this->getAccessToken();
                $ipList = json_decode(file_get_contents($url));
                if($ipList->errcode){
                    errlog(__FUNCTION__.' error:' .$ipList->errcode.':'.$ipList->errmsg.' '.__FILE__.'on '.__LINE__);
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

        if( $tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }


    /*
     * 获取js-sdk配置
     */

    function getJssdkConfig(){
        $url = I('url','');
        Validator::validate(array(
            array($url,array('require','url'),'url参数错误')
        ));
        if(Validator::getIns()->getError()['code'] != 0){
            exit(json_encode(Validator::getIns()->getError()));
        }
        $jssdk = new JSSDK();
        $singPackge = $jssdk->getSignPackage($url);
        return $singPackge;
    }



}
?>