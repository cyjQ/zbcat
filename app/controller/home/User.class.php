<?php
class User extends CModel {
    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $this->display();
    }

    /*
     * 用户注册处理
     */
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
            $data['create_time'] = time();
            $data['IP'] = $_SERVER['REMOTE_ADDR'];
            $user = D('user');
            $res = $user->add($data);
            if($res){
                exit(json_encode(array('code'=>0,'msg'=>'注册成功')));
            }else{
                exit(json_encode(array('code'=>1,'msg'=>'注册失败，请重试')));
            }
        }
    }

    public function login(){
        $this->display();
    }
    /*
     * 用户登录处理
     */
    public function login_handler(){
        $filter = array('trim','htmlentities');
        $data['pwd'] = md5(I('pwd','',$filter));
        $data['email'] = I('email','',$filter);
        $user = D('user');
        $res = $user->where($data)->find();
        if($res){
            if($res['pwd'] == $data['pwd']  && $res['email']  == $data['email']){
                session('login_ip',$_SERVER['REMOTE_ADDR']);
                session('id',$res['id']);
                session('username',$res['username']);
                exit(json_encode(array('code'=>0,'msg'=>'登录成功')));
            }else{
                exit(json_encode(array('code'=>2,'msg'=>'用户名或密码错误')));
            }
        }else{
            exit(json_encode(array('code'=>1,'msg'=>'用户名或密码错误')));
        }

    }

    /*
     * 注册成功页面
     */
    public function success_register(){
        $this->display();
    }

    public function ucenter(){
        $file = File::getIns();
        $this->display();
    }

    public function set_avatar_pc(){
        $this->display();
    }

    public function set_avatar(){
        $res = File::getIns()->upload();
        if($res){
            var_dump(Image::getIns($res)->getImgInfo());
        }
    }
}