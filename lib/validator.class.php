<?php
/*
 *  验证数据类
 */
 class Validator{
     //对象装载属性
     private static $ins = null;

     //错误信息
     private $err=array(
         'code'=>0,
         'msg'=>''
     );

     //验证的数据对象
     protected $validate_data;

     /*
      * 验证规则
      */
     protected $rule=array(
         'require',
         'number',
         'string',
         'phone',
         'email',
         'lt',
         'gt',
         'maxlen',
         'minlen',
         'url'
     );

    protected function __construct(){
    }

    public static function getIns(){
        if(self::$ins === null){
            self::$ins = new self();
        }
        return self::$ins;
    }

    /*
     * 执行验证
     * demo
     * $args = array(
     *   array('data','rule',msg)
     *   array('data',array('require','number'),msg)
     *   array('data',array('require','number',array('maxlen',7)),msg)
     * )
     */
    public static function validate($args){
        if(!is_array($args) || count($args)<1 || !is_array($args[0])) {
            errlog('验证参数传递错误');
            self::getIns()->err['code'] = 1;
            self::getIns()->err['msg'] ='验证参数传递错误';
            if(DEBUG){
                echo self::getError();
            }
            return self::getIns()->getError();
        }
        foreach ($args as $data){
            self::getIns()->validate_data = $data[0];
            //多个验证规则
            if(is_array($data[1])){
                foreach ($data[1] as $validate){
                    //传参验证
                    if(is_array($validate)){
                        if(in_array($validate[0],self::getIns()->rule)){
                            $method = 'vd_'.$validate[0];
                            $res = self::getIns()->$method($validate[1]);
                            if(!$res){
                                self::getIns()->err['code'] = 2;
                                if(isset($data[2])){
                                    self::getIns()->err['msg']= $data[2];
                                }else{
                                    self::getIns()->err['msg']= "'".self::getIns()->validate_data."'验证未通过";
                                }
                                errlog(self::getIns()->err['msg']);
                                return false;
                            }

                        }else{
                            self::getIns()->err['code'] = 3;
                            self::getIns()->err['msg'] = '验证规则错误,"'.$validate[0].'"此验证规则不支持';
                            errlog(self::getIns()->err['msg']);
                            if(DEBUG){
                                echo self::getIns()->err['msg'];
                            }
                            return false;
                        }
                        //不需传参验证
                    }else{
                        if(!in_array($validate,self::getIns()->rule)){
                            self::getIns()->err['code'] = 3;
                            self::getIns()->err['msg'] = '验证规则错误,"'.$validate.'"此验证规则不支持';
                            errlog(self::getIns()->err['msg']);
                            if(DEBUG){
                                echo self::getIns()->err['msg'];
                            }
                            return false;
                        }
                        $method = 'vd_'.$validate;
                        $res = self::getIns()->$method();
                        if(!$res){
                            self::getIns()->err['code'] = 2;
                            if(isset($data[2])){
                                self::getIns()->err['msg']= $data[2];
                            }else{
                                self::getIns()->err['msg']= "'".self::getIns()->validate_data."'验证未通过";
                            }
                            errlog(self::getIns()->err['msg']);
                            return false;
                        }
                    }
                }
                //单个验证规则
            }else{
                if(!in_array($data[1],self::getIns()->rule)){
                    self::getIns()->err['code'] = 3;
                    self::getIns()->err['msg'] = '验证规则错误,"'.$data[1].'"此验证规则不支持';
                    errlog(self::getIns()->err['msg']);
                    if(DEBUG){
                        echo self::getIns()->err['msg'];
                    }
                    return false;
                }
                $method = 'vd_'.$data[1];
               $res =  self::getIns()->$method();
                if(!$res){
                    self::getIns()->err['code'] = 2;
                    if(isset($data[2])){
                        self::getIns()->err['msg']= $data[2];
                    }else{
                        self::getIns()->err['msg']= "'".self::getIns()->validate_data."'验证未通过";
                    }
                    errlog(self::getIns()->err['msg']);
                    return false;
                }
            }
        }
        return true;
    }

     /*
      * 返回错误信息
      */
     public function getError(){
         return $this->err;
     }

     /*
      * 必需存在验证
      */
     protected function vd_require(){
         if($this->validate_data == null || trim($this->validate_data) == ''){
             return false;
         }else{
             return true;
         }
     }

     /*
      * 数字验证
      */
     protected function vd_number(){
         return is_numeric($this->validate_data);
     }
     /*
      * 邮箱的验证
      */
     protected function vd_email(){
        $pattern = '/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/';
         return preg_match($pattern,$this->validate_data,$match);
     }
     /*
      * 字符串的验证
      */
     protected function vd_string(){
         return is_string($this->validate_data);

     }
     /*
      * 电话号码的验证
      */
     protected function vd_phone(){
         $pattern = '/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/';
         return preg_match($pattern,$this->validate_data,$match);
     }

     /*
      * 小于某值
      */
     protected function vd_lt($val){
            return $this->validate_data <$val;
     }
     /*
      * 大于某值
      */
     protected function vd_gt($val){
         return $this->validate_data > $val;
     }
     /*
      * 限制的最大长度
      */
     protected function vd_maxlen($val){
         return strlen($this->validate_data) <= $val;
     }
    /*
     * 限制的最小长度
     */
     protected function vd_minlen($val){
         return strlen($this->validate_data) >= $val;
     }

     /*
      * 验证url
      */

     protected function vd_url(){
        return filter_var($this->validate_data,FILTER_VALIDATE_URL);
     }

 }
