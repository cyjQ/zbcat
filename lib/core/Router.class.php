<?php
class Router{
    //实列类参数
    protected static $ins=null;

     //请求url信息
    public $request_info;

    //请求的模型类
    public $model;

    //请求的模型方法
    public $controller;

    //解析出的请求信息
    public $query_string=array();

    //分组名
    public $group = null;

    //错误信息
    protected $err;

    /*
     * 初始化请求数据
     */
    protected function __construct(){
        $this->request_info = $_GET;
        $this->getArgs();
    }

    /*
     * 单列化类
     */
    public static function getIns(){
        if(self::$ins === null){
            self::$ins = new self();
        }
        return self::$ins;
    }

    /*
     * 解析获取请求参数
     */
    protected function getArgs(){
        if(count($this->request_info)>0){
            /*$request_args = $this->request_info[0];
            $args = $this->explode_query_string($request_args);*/
            $args = $this->request_info;
            if(isset($args['m'])){
                $this->model = ucfirst($args['m']);
            }else{
                $this->model ="Index";
            }
            if(isset($args['c'])){
                $this->controller = $args['c'];
            }else{
                $this->controller = "index";
            }

            if(isset($args['g']) && C('GROUP_LIST')){
                $this->group = $args['g'];
                $this->query_string['g'] =$this->group;
            }

        }else{
            $this->model = "Index";
            $this->controller="index";

        }
        if($this->group === null){
            $this->getGroup();
        }

        $this->query_string['m']=$this->model;
        $this->query_string['c'] = $this->controller;
    }

    /*
     * 解析请求
     */
    protected function explode_query_string($str){
        if(trim($str)==''){
            errlog("请求切割的参数字符串为空");
            return false;
        }
        $args = array();
        $one_str = explode("&",$str);
        foreach ($one_str as $val){
            $two_str=explode("=",$val);
            $args[$two_str[0]] =$two_str[1];
        }

        return $args;
    }

    /*
     * 解析获取分组名
     */
    protected function getGroup(){
        if(C('GROUP_LIST')){
            $group_list = explode(",",C('GROUP_LIST'));
            if(count($group_list)>0) {
                if (C('DEFAULT_GROUP')) {
                    $this->query_string['g'] = C('DEFAULT_GROUP');
                }else{
                    $this->query_string['g'] = $group_list[0];
                }
            }
        }else{
            $this->query_string['g'] = false;
        }
    }

    /*
     * 执行url路由
     */
    public function dispatcher(){
        $query_path = ROOT_DIR."app/controller/";
        if($this->query_string['g']){
            $query_path .= $this->query_string['g'].DIRECTORY_SEPARATOR;
        }
        $query_path .=$this->query_string['m'].".class.php";
        if($this->class_is_exists($query_path)){
            include_once $query_path;
            if(class_exists($this->query_string['m'])){
                $class = new $this->query_string['m']();
                $method = strtolower($this->query_string['c']);
                define('MODEL',$this->query_string['m']);
                define('CONTROLLER',$this->query_string['c']);
                define('GROUP',$this->query_string['g']);
                $class->$method();
            }else{
                $this->err = $this->query_string['m'].'不存在';
                errlog($this->err);
                return false;
            }
        }else{
            $this->err=$query_path.'不存在';
            errlog($this->err);
            return;
        }
    }

    /*
     * 判断请求的类文件是否存在
     */
    protected function class_is_exists($class_file)
    {
        if (is_file($class_file) && file_exists($class_file)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 获取错误信息
     */
    public function getError(){
        return $this->err;
    }

}