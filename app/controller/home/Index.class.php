<?php
class Index extends CModel{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        if(Session::is_login()){
            echo '登录了';

        }else{
            echo '没有登录';
        }
        $this->display();
    }
}

?>