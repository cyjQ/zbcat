<?php /* Smarty version Smarty-3.1.14, created on 2017-03-05 15:43:10
         compiled from "./templates/Public/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183104594558b97ad9b03b59-51147749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a87a37ab026b736d0c05f21670787e3d842ac95' => 
    array (
      0 => './templates/Public/header.tpl',
      1 => 1488699566,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183104594558b97ad9b03b59-51147749',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_58b97ad9c42069_39828238',
  'variables' => 
  array (
    'site_name' => 0,
    '__PUBLIC__' => 0,
    '__PLUGIN__' => 0,
    '__CSS__' => 0,
    '__IMG__' => 0,
    'banner' => 0,
    'vo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b97ad9c42069_39828238')) {function content_58b97ad9c42069_39828238($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $_smarty_tpl->tpl_vars['site_name']->value;?>
</title>
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PUBLIC__']->value;?>
/js/jquery-3.1.1.min.js"></script>
    <link href="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['__PLUGIN__']->value;?>
/layer/layer.min.js"></script>
    <link href="<?php echo $_smarty_tpl->tpl_vars['__CSS__']->value;?>
/style.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['__CSS__']->value;?>
/home/header.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="header">
    <nav class="navbar navbar-default" id="front-nav" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="/"><img alt="Get ExpressVPN" width="175.133" height="36" src="<?php echo $_smarty_tpl->tpl_vars['__IMG__']->value;?>
home/logo.png">
                </a></div>
            <div class="navbar-collapse collapse" style="height: 1px;">
                <ul class="nav navbar-nav navbar-right">
                            <?php  $_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->key => $_smarty_tpl->tpl_vars['vo']->value){
$_smarty_tpl->tpl_vars['vo']->_loop = true;
?>
                            <li>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value['name'];?>
</a>
                            </li>
                            <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="clear"></div>


<?php }} ?>