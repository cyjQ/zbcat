<?php /* Smarty version Smarty-3.1.14, created on 2016-10-15 18:49:34
         compiled from "./templates/Public/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169694896657b9b881b91161-68470059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a87a37ab026b736d0c05f21670787e3d842ac95' => 
    array (
      0 => './templates/Public/header.tpl',
      1 => 1476528569,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169694896657b9b881b91161-68470059',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57b9b881b99134_98109988',
  'variables' => 
  array (
    '__PLUGIN__' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b9b881b99134_98109988')) {function content_57b9b881b99134_98109988($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>抓宝猫财务管家</title>
    <link href="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
<div class="container">
    <div class="row">
        <div class="col-md-10" id="body-box">
            <div class="col-md-9">
                <nav class="navbar navbar-default nav-set" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">首页</a>
                        </div>
                        <div>
                            <ul class="nav navbar-nav nav-ul">
                                <li class="active"><a href="#" class="nav-a">广场</a></li>
                                <li><a href="#" class="nav-a">个人中心</a></li>
                                <li><a href="#" class="nav-a">关于我们</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-3">
                <nav class="navbar navbar-default nav-set" role="navigation">
                    <div class="container-fluid">
                        <div>
                            <ul class="nav navbar-nav nav-ul">
                                <li><a href="#" class="nav-a">登录</a></li>
                                <li><a href="#" class="nav-a">注册</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div><?php }} ?>