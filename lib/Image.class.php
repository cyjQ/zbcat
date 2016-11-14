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
    public static function getIns($file){
        if(self::$ins === null){
            self::$ins = new self($file);
        }
        return self::$ins;
    }

    protected function init($file){
        $this->allowType = C('ALLOW_IMG_TYPE');
        $this->imgFile = $file;
    }

    public function getImgInfo(){
        if(!(is_file($this->imgFile) && file_exists($this->imgFile))){
            $this->setErr('图片文件不存在',1);
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
                $this->setErr('"'.$this->compareSuffix[$imginfo[2]].'",不允许此格式的图片',2);
                return false;
            }
        }else{
            $this->setErr('"'.$this.$this->imgFile.'"不是图片文件',3);
        }
    }


    public function cropImg($height,$width,$srcImg,$srcx,$srcy){

    }

    protected function setErr($msg,$code){
        $this->err['msg'] = $msg;
        $this->err['code'] = $code;
        if(DEBUG){
            echo $this->err['msg'];
        }
        errlog($this->err['msg']);
    }

    public function getErr(){
        return $this->err;
    }

}