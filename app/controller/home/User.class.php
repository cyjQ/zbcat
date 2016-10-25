<?php
class User extends CModel {
    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $this->display();
    }

    public function register_handler(){
        $filter = array('trim','htmlentities');
        $data['username']=  I('username','',$filter);
        $data['pwd'] = I('pwd','',$filter);
        $repwd = I('repwd','',$filter);
        $data['emial'] = I('email','',$filter);
        Validator::validate(array(
            array($data['username'],array('require'),'用户名不能为空'),
            array($data['pwd'],array('require',array('minlen',6),array('maxlen',16)),'密码必填，且必须是6-16位长度'),
            array($data['emial'],array('require'),'邮箱必填，且格式需正确'),
        ));
        if(Validator::getIns()->getError()['code'] != 0){
            exit(json_encode(Validator::getIns()->getError()));
        }else{
            exit(json_encode(array('msg'=>'validate ok!')));
        }
    }
}