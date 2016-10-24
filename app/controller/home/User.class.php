<?php
class User extends CModel {
    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $this->display();
    }
}