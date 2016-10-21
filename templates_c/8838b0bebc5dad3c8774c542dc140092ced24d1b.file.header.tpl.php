<?php /* Smarty version Smarty-3.1.14, created on 2016-10-21 19:05:22
         compiled from ".\templates\Public\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2652058070a8cbb3574-12571054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8838b0bebc5dad3c8774c542dc140092ced24d1b' => 
    array (
      0 => '.\\templates\\Public\\header.tpl',
      1 => 1477047271,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2652058070a8cbb3574-12571054',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_58070a8cc76aa5_88907301',
  'variables' => 
  array (
    '__PLUGIN__' => 0,
    '__CSS__' => 0,
    'banner' => 0,
    'vo' => 0,
    '__IMG__' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58070a8cc76aa5_88907301')) {function content_58070a8cc76aa5_88907301($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>抓宝猫财务管家</title>
    <link href="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="<?php echo $_smarty_tpl->tpl_vars['__CSS__']->value;?>
/style.css" rel="stylesheet">
</head>
<body>
<div class="container logo-header">
    <div class="row">
        <div class="col-sm-1">1</div>
    </div>
</div>
<div class="container">
    <nav class="navbar navbar-default nav-nav" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse nav-div" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <?php  $_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->key => $_smarty_tpl->tpl_vars['vo']->value){
$_smarty_tpl->tpl_vars['vo']->_loop = true;
?>
                <li><a href="#"><?php echo $_smarty_tpl->tpl_vars['vo']->value['name'];?>
</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="email">
           <a><img src="<?php echo $_smarty_tpl->tpl_vars['__IMG__']->value;?>
home/envelope.gif">&nbsp;359889053@qq.com</a>
        </div>
    </nav>
</div>


<?php }} ?>