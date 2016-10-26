<?php
class CModel{
    //组合smarty
    public $smarty;
    public $err;
    /*
     * 初始化Smarty类
     */
    protected function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->left_delimiter = '<{';
        $this->smarty->right_delimiter = '}>';
        $this->__PUBLIC__ = __PUBLIC__;
        $this->ROOT_DIR   = ROOT_DIR;
        $this->__CSS__    = __CSS__;
        $this->__JS__     = __JS__;
        $this->__IMG__    = __IMG__;
        $this->__UP__     = __UP__;
        $this->__PLUGIN__ = __PLUGIN__;
        $this->get        = $_GET;
        $this->post       = $_POST;
        $this->request    = $_REQUEST;
        $this->session    = $_SESSION;
        $this->HOST       =HOST;

        $banner = C('Banner');
        $this->assign('banner',$banner);
        $this->assign('text_message',C('Text_message'));
    }

    /*
     * 空模块的处理
     */
    public function __call($name, $arguments){
        __empty();
    }

    /*
     * 重载smarty类的display()方法
     */
    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null){
        //如果$template为空，则默认调用与当前方法相同的模板
        if($template === null || trim($template)==''){
            if(GROUP){
                $template = GROUP.DIRECTORY_SEPARATOR.MODEL.DIRECTORY_SEPARATOR.CONTROLLER.'.tpl';
            }else{
                $template = MODEL.DIRECTORY_SEPARATOR.CONTROLLER.'.tpl';
            }
        }else{
            if(strpos($template,':')){
                if(C('GROUP_LIST')){
                    //判断分组是否存在
                    $group = explode(':',$template);
                    $groups = explode(',',C('GROUP_LIST'));
                    if(in_array($group[0],$groups)){
                        $template = str_replace(':',DIRECTORY_SEPARATOR,$template).'.tpl';
                    }else{
                        $this->err = '模板调用错误,'.$group[0].'分组名不存在！';
                        if(DEBUG){
                            echo $this->err;
                        }
                        errlog($this->err);
                        return;
                    }
                }else{
                    $this->err = '模板调用模式错误，当前未分组，请尝试”/model/cotroller.tpl“模式';
                    if(DEBUG){
                        echo $this->err;
                    }
                    errlog($this->err);
                    return ;
                }

            }else{
                if(GROUP){
                    if(strpos('/',$template)){
                        $template = GROUP.DIRECTORY_SEPARATOR.$template.'.tpl';
                    }else{
                        $template = GROUP.DIRECTORY_SEPARATOR.MODEL.DIRECTORY_SEPARATOR.$template.'.tpl';
                    }

                }else{
                    if(strpos('/',$template)){
                        $template .= '.tpl';
                    }else{
                        $template = MODEL.DIRECTORY_SEPARATOR.$template.'.tpl';
                    }
                }

            }
        }
        $this->smarty->display($template,$cache_id,$compile_id,$parent);
    }

    /*
     * 优化调用smarty类的assign()方法
     */
    public function __set($name, $value){
        $this->smarty->assign($name,$value);
    }

    /*
     * 重写assign()方法
     */

    public function assign($name,$value,$nocatch=false){
        $this->smarty->assign($name,$value,$nocatch);
    }
    /*
     * 页面跳转
     */
    public function urlJump($path){
        $default = 'http://'.HOST;
        $path =trim((string)$path);
        if($path == ''){
            $this->err = 'jump url not allowed to be the null';
            if(DEBUG){
                echo $this->err;
                return;
            }
            errlog($this->err);
        }
        $url= '';
        if(strpos($path,'/')){
            $pathinfo = explode('/',$path,2);
            $url .='m='.$pathinfo[0].'&c='.$pathinfo[1];
            if(GROUP){
                $url .= '&g='.GROUP;
            }
        }else{
            $url .= 'm='.MODEL.'&c='.$path;
            if(GROUP){
                $url .= '&g='.GROUP;
            }
        }
        if($url==''){
            $url = $default;
        }else{
            $url ='http://'.HOST.'?'.$url;
        }
        header("Location: $url");
        return;
    }
}
