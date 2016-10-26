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
        $data['email'] = I('email','',$filter);
        Validator::validate(array(
            array($data['username'],'require','用户名不能为空'),
            array($data['pwd'],array(array('minlen',6),array('maxlen',16)),'密码必填，且必须是6-16位长度'),
            array($data['email'],array('require','email'),'邮箱必填，且格式需正确'),
        ));
        if(Validator::getIns()->getError()['code'] != 0){
            exit(json_encode(Validator::getIns()->getError()));
        }else{
            $data['pwd'] = md5($data['pwd']);
            $user = D('user');
            $res = $user->add($data);
            if($res){
                exit(json_encode(array('code'=>0,'msg'=>'注册成功')));
            }else{
                exit(json_encode(array('code'=>1,'msg'=>'注册失败，请重试')));
            }
        }
    }
}