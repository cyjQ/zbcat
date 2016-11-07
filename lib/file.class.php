<?php
class File{
    public static $ins = null;
    protected $error=array(
        'code'=>0,
        'msg'=>''
    );
    protected $allow_type;
    protected $file;
    protected $file_suffix;
    protected $file_info=array();
    public $savePath;

    protected function __construct(){
        $this->ini();
    }

    public  static function getIns(){
        if(self::$ins === null){
            self::$ins = new self();
        }
        return self::$ins;
    }

    protected function ini(){
        $this->allow_type = C('ALLOW_FILE_TYPE');
        $this->savePath = C('savePath');
    }


    /*
     * 获取错误信息
     */
    public function getError(){
        return $this->error;
    }

    /*
     * 获取文件的后缀
     */
    protected function getSuffix(){
        $this->file_suffix = explode('/',$this->file['type'])[1];
        return $this->file_suffix;
    }

    protected function isAllow(){
        return in_array($this->file_suffix,$this->allow_type);
    }

    /*
     * 生成随机的文件名
     */

    protected function createFileName(){
        $return = '';
        $str ='abcd1234567890efghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = str_shuffle($str);
        for($i=0;$i<6;$i++){
            $k = rand(0,strlen($str)-1);
            $return .= $str[$k];
        }

        return time().$return.'.'.$this->file_suffix;

    }

    /*
     * 根据日期创建上传目录
     */
    protected function mkDirectory(){
        $date_fomate = date('Y/m/d',time());
        $path = $this->savePath.$date_fomate;
        if(is_dir($path)){
            return $path;
        }else{
            $res = mkdir($path,0777,true);
            if($res){
                return $path;
            }else{
                $this->setErr('创建目录:'.$path.'失败，请手动创建',3);
                return false;
            }
        }

    }

    public function upload(){
        if(count($_FILES) <1){
            $this->setErr('没发现上传的文件',1);
            return false;
        }

        foreach ($_FILES as $fileKey=>$file){
            $this->file = $file;
            $this->file_info[$fileKey]['type'] = $this->getSuffix();
            if(!$this->isAllow()){
                $this->setErr('"'.$this->file_suffix.'"'.'是不允许的类型',2);
                return false;
            }

            $save_file_name = $this->createFileName();
            $sava_path = $this->mkDirectory();
            if(!$sava_path){
                return false;
            }
            $newFileName = $sava_path.'/'.$save_file_name;

            if(is_uploaded_file($file['tmp_name'])){
                if(move_uploaded_file($file['tmp_name'],$newFileName)){
                    $this->file_info[$fileKey]['saveName'] = $newFileName;
                    $this->file_info[$fileKey]['size'] = $file['size'];
                    $this->file_info[$fileKey]['name'] = $file['name'];
                    return $newFileName;
                }else{
                    $this->setErr('上传失败,请重试',4);
                    return false;
                }
            }


        }
        return false;

    }

    /*
     * 获取上传文件的详细信息
     *
     */
    public function getFileInfo(){
        return $this->file_info;
    }

    protected function setErr($msg,$code){
        $this->error['msg'] = $msg;
        $this->error['code'] = $code;
        if(DEBUG){
            echo $this->error['msg'];
        }
        errlog($this->error['msg']);
    }

}
