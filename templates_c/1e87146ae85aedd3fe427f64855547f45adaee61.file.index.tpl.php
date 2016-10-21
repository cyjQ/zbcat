<?php /* Smarty version Smarty-3.1.14, created on 2016-08-24 23:06:29
         compiled from "./templates/home/Index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167239793557bdb7f5d38059-24741957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e87146ae85aedd3fe427f64855547f45adaee61' => 
    array (
      0 => './templates/home/Index/index.tpl',
      1 => 1471962641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167239793557bdb7f5d38059-24741957',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '__PUBLIC__' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57bdb7f5e9b885_20342875',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57bdb7f5e9b885_20342875')) {function content_57bdb7f5e9b885_20342875($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Public/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo'), 0);?>

<h1><?php echo $_smarty_tpl->tpl_vars['__PUBLIC__']->value;?>
</h1>
欢迎你<font color='green'><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</font><?php }} ?>