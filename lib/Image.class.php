<?php
class Image{
    protected static $ins = null;
    protected $allowType;
    protected $imgFile;
    protected $imgInfo;
    protected $err = array(
        'msg'=>'',
        'code'=>0
    );

    protected $compareSuffix= array(
        1=>'gif',
        2=>'jpg',
        3=>'png',
        4=>'swf',
        5=>'psd',
        6=>'bmp',
        7=>'tiff',
        8=>'tiff',
        9=>'jpc',
        10=>'jp2',
        11=>'jpx',
        12=>'jb2',
        13=>'swc',
        14=>'iff',
        15=>'wbmp',
        16=>'xbm',
    );

    protected function __construct($file){
        $this->init($file);
    }
    /*
     * 获取实列对象
     */
    public static function getIns($file){
        if(self::$ins === null){
            self::$ins = new self($file);
        }
        return self::$ins;
    }

    /*
     * 初始化配置
     */
    protected function init($file){
        $this->allowType = C('ALLOW_IMG_TYPE');
        $this->imgFile = $file;
    }
    /*
     * 获取图片的信息
     */
    public function getImgInfo(){
        if(!(is_file($this->imgFile) && file_exists($this->imgFile))){
            $this->setErr($this->imgFile.' is not exists',1);
            return false;
        }
        $imginfo = getimagesize($this->imgFile);
        if(key_exists($imginfo[2],$this->compareSuffix)){
            if(in_array($this->compareSuffix[$imginfo[2]],$this->allowType)){
                $this->imgInfo['height'] = $imginfo[1];
                $this->imgInfo['width'] = $imginfo[0];
                $this->imgInfo['mime'] = $imginfo['mime'];
                $this->imgInfo['type'] = $this->compareSuffix[$imginfo[2]];
                $this->imgInfo['mime'] = $imginfo['mime'];
                return $this->imgInfo;
            }else{
                $this->setErr('"'.$this->compareSuffix[$imginfo[2]].'",the image type is not allowed',2);
                return false;
            }
        }else{
            $this->setErr('"'.$this.$this->imgFile.'"is not a image file',3);
        }
    }


    /*
     * 图片的裁剪
     */
    public function cropImg($height,$width,$srcx,$srcy){
        if($height<=0 || $width<=0){
            $this->setErr('cropImg Error:the param height or width is not rightful!',4);
            return false;
        }
        $imgInfo = $this->getImgInfo();
        $imFunc = 'imagecreatefrom'.$imgInfo['type'];
        $im =  imagecreatetruecolor($width,$height);
        if(function_exists($imFunc)){
            $imSrc = $imFunc($this->imgFile);
        }else{
            errlog('function '.$imFunc.' is not exists');
            return false;
        }

    }

    /*
     * 设置错误消息
     */
    protected function setErr($msg,$code){
        $this->err['msg'] = $msg;
        $this->err['code'] = $code;
        errlog($this->err['msg']);
    }

    /*
     * 获取错误消息
     */
    public function getErr(){
        return $this->err;
    }

}