<?php
class Index extends CModel{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $banner = C('Banner');
        $this->assign('banner',$banner);
        $this->assign('text_message',C('Text_message'));
        $this->display();
    }
}

?>