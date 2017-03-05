<?php
class Login extends CModel{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->display();
    }
}
?>