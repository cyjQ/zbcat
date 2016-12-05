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
            if($data['pwd'] != $repwd){
                exit(json_encode(array('code'=>2,'msg'=>'密码与确认密码不一致!')));
            }
            $user = D('user');
            $res = $user->where(array('email'=>$data['email']))->find();
            if($res){
                exit(json_encode(array('code'=>3,'msg'=>'该邮箱已注册')));
            }
            $data['pwd'] = md5($data['pwd']);
            $data['create_time'] = time();
            $data['IP'] = $_SERVER['REMOTE_ADDR'];

            $res = $user->add($data);
            $res = $user->where(array('id'=>$res))->find();
            if($res){
                session('login_ip',$_SERVER['REMOTE_ADDR']);
                session('id',$res['id']);
                session('username',$res['username']);
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
                $last_login_time = $res['this_login_time'];
                $user->where(array('id'=>$res['id']))->save(array('last_login_time'=>$last_login_time,'this_login_time'=>time()));
                exit(json_encode(array('code'=>0,'msg'=>'登录成功','redirect_url'=>Session::uGoTo(false))));
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

    /*
     * 用户中心
     */
    public function ucenter(){

        //判断用户是否登录
        if(!(Session::is_login())){
            $this->urlJump('login');
            return;
        }
        $this->display();
    }

    /*
     * pc端用户头像设置页面
     */
    public function set_avatar_pc(){
        $this->display();
    }

    /*
     * 保存用户信息
     */
    public function save_info(){
        $data = array_map('htmlentities',array_map('trim',$_POST));
        if(time($data['birthday']) != ''){
            $data['birthday'] = strtotime($data['birthday']);
        }
        $user = D('user');
        $res = $user->where(array('id'=>session('id')))->save($data);
        if($res){
            jsOutput('保存成功!');
        }else{
            jsOutput('失败，请重试',1);
        }
    }

    /*
     * 设置用户的头像
     */
    public function set_avatar(){
        $res = File::getIns()->upload();
        if($res){
            //裁剪图片
            $img = Image::getIns($res);
            $avtar = $img->cropImg($_POST['height'],$_POST['width'],$_POST['x'],$_POST['y']);
            if($avtar){
                $user = D('user');
                if($res = $user->where(array('id'=>session('id')))->save(array('avatar'=>$avtar))){
                    exit(json_encode(array('code'=>0,'msg'=>'头像设置成功')));
                }else{
                    exit(json_encode(array('code'=>0,'msg'=>'头像设置失败')));
                }
            }else{
                $err = $img->getErr();
                exit(json_encode($err));
            }
        }
    }

    /*
     * 退出登录
     */
    public function login_out(){
        session('login_ip','');
        session('id','');
        session('username','');
        $this->urlJump('login');
    }

    public function mPwd(){
        $this->display();
    }

    /*
     * 修改密码
     */
    public function mpwd_handler(){
        $old_pwd = I('old_pwd','','trim');
        $new_pwd = I('new_pwd','','trim');
        $res_new_pwd = I('res_new_pwd','','trim');
        Validator::validate(array(
            array($old_pwd,'require','旧密码必须输入'),
            array($res_new_pwd,'require','确认新密码必须输入'),
            array($new_pwd,array(array('minlen',6),array('maxlen',16)),'新密码必填，且必须是6-16位长度'),
        ));
        if(Validator::getIns()->getError()['code'] != 0){
            exit(json_encode(Validator::getIns()->getError()));
        }
        if($res_new_pwd != $new_pwd){
            jsOutput('新密码与确认新密码不一致，请重新输入');
        }
        $user = D('user');
        $user_info = $user->find(session('id'));
        if(!$user_info){
            jsOutput('请重新登录',2);
        }
        if($user_info['pwd'] != md5($old_pwd)){
            jsOutput('旧密码输入错误',3);
        }
        $res = $user->where(array('id'=>session('id'),'pwd'=>md5($old_pwd)))->save(array('pwd'=>md5($new_pwd)));
        if($res){
            jsOutput('密码修改成功');
        }else{
            jsOutput('密码修改失败，请重试！',1);
        }

    }

}