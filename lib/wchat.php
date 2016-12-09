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
     * 获取公众号token
     */
    private function getAccessToken() {
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";
            $res = json_decode(httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $this->set_php_file("access_token.php", json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
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
     * 获取js-sdk ticket
     */
    private function getJsApiTicket() {
        $data = json_decode($this->get_php_file("jsapi_ticket.php"));
        if ($data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode(httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $this->set_php_file("jsapi_ticket.php", json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    /*
     *创建随机字符串
     */
    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
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
        $jsapiTicket = $this->getJsApiTicket();
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId"     => $this->appid,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }
    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }



}
?>