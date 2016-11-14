<?php
class Wchat{
    protected $appid;
    protected $secret;
    public static $ins = null;
    protected function ini($appid,$secret){
        $this->appid = $appid;
        $this->secret = $secret;
        $this->getAccessToken();
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
        echo $url;
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


}
?>