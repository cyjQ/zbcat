<?php
defined("ROOT_DIR")?"":define("ROOT_DIR", str_replace("ini.php","",str_replace("\\",DIRECTORY_SEPARATOR,__FILE__)));
include ROOT_DIR."lib".DIRECTORY_SEPARATOR."function.php";
defined("CONFIG_PATH")?'':define('CONFIG_PATH',ROOT_DIR.'conf');
//加载lib目录文件
load(ROOT_DIR.'lib',1);
Session::init();
defined('__PUBLIC__')?'':define('__PUBLIC__','/Public'.'/');
defined('__JS__')?'':define('__JS__',__PUBLIC__.'js'.DIRECTORY_SEPARATOR);
defined('__CSS__')?'':define('__CSS__',__PUBLIC__.'css'.DIRECTORY_SEPARATOR);
defined('__PLUGIN__')?'':define('__PLUGIN__',__PUBLIC__.'plugin'.DIRECTORY_SEPARATOR);
defined('__UP__')?'':define('__UP__',__PUBLIC__.'up'.DIRECTORY_SEPARATOR);
defined('__IMG__')?'':define('__IMG__',__PUBLIC__.'img'.'/');
defined('HOST')?'':define('HOST',$_SERVER['HTTP_HOST']);
defined('DEBUG')?'':define('DEBUG',TRUE);
date_default_timezone_set("HongKong");
//数据转义
if(get_magic_quotes_gpc() ==0){
	function slash_deep($value){
		$value = is_array($value)?
		array_map("slash_deep",$value):
		addslashes($value);
		return $value;
	}
}
if(function_exists("slash")){
	$_POST = array_map('slash_deep',$_POST);
	$_REQUEST = array_map('slash_deep',$_REQUEST);
	$_GET = array_map('slash_deep',$_GET);
}
//引进 smarty 模板
include_once ROOT_DIR.'Smarty'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';
//路由
Router::getIns()->dispatcher();

?>
