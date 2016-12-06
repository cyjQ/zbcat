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

        if( $tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

    public function create_noncestr(){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = str_shuffle($str);
        $nostr = '';
        for ($i=0;$i<8;$i++){
            $nostr .= $str[$i];
        }
        return $nostr;
    }


    /*
     * 获取js-ticket
     */
    public function getJsTicket(){
        $wx = D('wx_conf',1);
        $ticket = $wx->where(array('conf_colum'=>'js_ticket'))->find();
        if(!$ticket || $ticket['create_time'] < time()){
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=wx_card";
            $res = https_request($url,'');
            $ticket_info = json_decode($res);
            if($ticket_info->errcode >0){
                errlog(__FUNCTION__.': '.$ticket_info->errmsg.' '.__FILE__.' '.__LINE__);
                return false;
            }
            $data['create_time'] = ($ticket_info->expires_in + time() -5);
            $data['conf_colum'] = 'js_ticket';
            $data['access_token'] = $ticket_info->ticket;
            if(!$ticket){
                $wx->add($data);
            }elseif($ticket['create_time'] <time()){
                $wx->where(array('conf_colum'=>'js_ticket'))->save($data);
            }
            return $ticket_info->ticket;
        }
        return $ticket['access_token'];
    }

    /*
     * 获取js-sdk配置
     */

    function getJssdkConfig(){
        $conf['appid'] = C('appid');
        $conf['timestamp'] = time();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $ticket = $this->getJsTicket();
        if(!$ticket){
            errlog('获取js_ticket失败');
            return false;
        }
        $conf['noncestr'] = $this->create_noncestr();
        $tmpArr = array(
            'url'=>$url,
            'jsapi_ticket'=>$ticket,
            'timestamp'=>$conf['timestamp'],
            'noncestr'=>$conf['noncestr']
        );
        ksort($tmpArr, SORT_STRING);
        $string1 = http_build_query( $tmpArr );
        $string1 = urldecode( $string1 );
        $conf['signature'] = sha1( $string1 );
        $conf['jsapi_ticket'] = $ticket;
        $conf['url'] = $url;
        $conf['string1'] = $string1;
        exit(json_encode($conf));

    }



}
?>