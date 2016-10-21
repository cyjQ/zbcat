<?php /* Smarty version Smarty-3.1.14, created on 2016-08-23 22:30:45
         compiled from "./templates/Index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169915186657b31dc1dc43a8-64317577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a188df5f1a861d390356e947bfb426d05975ff54' => 
    array (
      0 => './templates/Index/index.tpl',
      1 => 1471962641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169915186657b31dc1dc43a8-64317577',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57b31dc1e140e1_74961313',
  'variables' => 
  array (
    '__PUBLIC__' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b31dc1e140e1_74961313')) {function content_57b31dc1e140e1_74961313($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Public/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo'), 0);?>

<h1><?php echo $_smarty_tpl->tpl_vars['__PUBLIC__']->value;?>
</h1>
欢迎你<font color='green'><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</font><?php }} ?>