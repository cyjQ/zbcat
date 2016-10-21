<?php
class Index extends CModel{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        /*if(!session('username')){
            $this->urlJump('Login/index');
            return;
        }*/
        $this->display();

    }
}

?>