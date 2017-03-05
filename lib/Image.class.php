<?php
class Image{
    protected static $ins = null;
    protected $allowType;
    protected $imgFile;
    protected $imgInfo;
    protected $cropPrefix='crap';
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
    public function cropImg($height,$width,$srcx,$srcy,$savepath=''){
        if($height<=0 || $width<=0){
            $this->setErr('cropImg Error:the param height or width is not rightful!',4);
            return false;
        }
        $imgInfo = $this->getImgInfo();
        if($imgInfo['type'] == 'jpg'){
            $funExt = 'jpeg';
        }else{
            $funExt = $imgInfo['type'];
        }
        $imFunc = 'imagecreatefrom'.$funExt;
        $im =  imagecreatetruecolor($width,$height);
        if(function_exists($imFunc)){
            $imSrc = $imFunc($this->imgFile);
        }else{
            errlog('function '.$imFunc.' is not exists');
            return false;
        }

        imagecopyresampled($im,$imSrc,0,0,$srcx,$srcy,$imgInfo['width'],$imgInfo['height'],$imgInfo['width'],$imgInfo['height']);
        $saveFun = 'image'.$funExt;
        if($savepath){
            $filename = $savepath.$this->buildFileName();
        }else{
            $filename = substr(str_replace('\\','/',$this->imgFile),0,strripos(str_replace('\\','/',$this->imgFile),'/')).'/'.$this->cropPrefix.'_'.$this->buildFileName();
        }
        if(function_exists($saveFun)){
            if($saveFun($im,$filename)) {
                return $filename;
            }
        }else{
            errlog('crop image error,the function '.$saveFun.' is not found');
            return false;
        }
        return false;
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
     * 生成文件名
     */

    protected function buildFileName($len=32){
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $fileName = (string)time();
        $len = $len - strlen($fileName);
        if($len < 0){
            errlog('buildFileName Error:file name need min len '.strlen($fileName));
            return false;
        }
        for($i=0;$i<$len;$i++){
            $shuf_str = str_shuffle($str);
            $fileName .= $shuf_str[$i];
        }
        $imgInfo = $this->getImgInfo();
        $fileName .= '.'.$imgInfo['type'];
        return $fileName;
    }

    /*
     * 获取错误消息
     */
    public function getErr(){
        return $this->err;
    }

}