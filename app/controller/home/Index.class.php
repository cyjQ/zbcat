<?php
class Index extends CModel{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->display();
    }
}

?>