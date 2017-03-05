<?php /* Smarty version Smarty-3.1.14, created on 2017-03-05 15:43:12
         compiled from "./templates/home/Account/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38928461258b97adb9a9e59-08995552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '095e559dc2ecdadaa54c3b72e93264d3d2d6af15' => 
    array (
      0 => './templates/home/Account/index.tpl',
      1 => 1488699566,
      2 => 'file',
    ),
    'b2e50621a1240333c82f5183b3e267593fdec39b' => 
    array (
      0 => './templates/home/Account/public.tpl',
      1 => 1488699566,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38928461258b97adb9a9e59-08995552',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_58b97adba2c8a7_74281262',
  'variables' => 
  array (
    '__CSS__' => 0,
    '__IMG__' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b97adba2c8a7_74281262')) {function content_58b97adba2c8a7_74281262($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("Public/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo'), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['__CSS__']->value;?>
/home/account.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-sm-4 right">
            <div class="user_account_info">
                <div class="account_user_avatar">
                    <img class="user-avater" src="<?php echo $_smarty_tpl->tpl_vars['__IMG__']->value;?>
home/perso1.jpg">
                    <p>抓宝猫</p>
                </div>
                <div class="user-jl hidden-xs">
                    <p>
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;
                        您与<span style="color: burlywood">&nbsp;2008-5-3&nbsp;</span>开始记账,今天是您记账的第
                        <span class="tuchu">&nbsp;234&nbsp;</span>天
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;
                        截止今日,你总共记账了<span class="tuchu">&nbsp;97&nbsp;</span>笔流水
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-fire"></span>&nbsp;&nbsp;
                        您已经连续记账 <span class="tuchu">&nbsp;13&nbsp;</span>天
                    </p>
                    <p>
                    <hr style="border-top:1px solid;"/>
                    </p>
                    <p style="text-align: center">
                        无实名,无绑定,无认证,记账,就是放心!
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-8 left">
            <div class="account_nav">
                <ul>
                    <li class="click"><a href=""><span class="glyphicon glyphicon-home"></span>&nbsp;账户主页</a></li>
                    <li><a href=""><span class="glyphicon glyphicon-cog"></span>&nbsp;账目设置</a></li>
                    <li><a href=""><span class="glyphicon glyphicon-align-left"></span>&nbsp;报表</a></li>
                    <li><a href=""><span class="glyphicon glyphicon-list-alt"></span>&nbsp;流水详情</a></li>
                    <li><a href=""><span class="glyphicon glyphicon-file"></span>&nbsp;添加记账单</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            
<div class="account_title">
    资产概览
</div>
<div class="account_info">
    <div class="row hidden-xs">
        <div class="account_sj col-sm-4">
            <span>总收入 :</span>&nbsp;
            <p>50550.00</p>
        </div>
        <div class="account_sj col-sm-4">
            <span>总支出 :</span>&nbsp;
            <p style="color: green">30000.00</p>
        </div>
        <div class="account_sj col-sm-4">
            <span>可支配收入 :</span>&nbsp;
            <p style="color: black">2000.00</p>
        </div>
    </div>
    <table class="visible-xs">
        <tr>
            <td class="title_td">总收入 : &nbsp;</td>
            <td class="title_td">总支出 : &nbsp;</td>
            <td class="title_td">可支配收入 : &nbsp;</td>
        </tr>
        <tr>
            <td class="sj-td" style="color: green">70000.00</td>
            <td class="sj-td" style="color: red">600454.00</td>
            <td class="sj-td" style="color: black">7078780.00</td>
        </tr>
    </table>
</div>

<div class="account_title">
    收支表
</div>
<div class="account_info">
    <table>
        <tr>
            <td></td>
            <td class="title_td">本周</td>
            <td class="title_td">本月</td>
            <td class="title_td">本年</td>
        </tr>
        <tr>
            <td class="title_td">
                <span class="glyphicon glyphicon-plus" style="color: red;font-size: 10px;"></span>
                &nbsp;&nbsp;收入</td>
            <td class="sr-sj">¥320</td>
            <td class="sr-sj">¥3500</td>
            <td class="sr-sj">¥35000</td>
        </tr>
        <tr>
            <td class="title_td">
                <span class="glyphicon glyphicon-minus" style="color: green;font-size: 10px;"></span>
                &nbsp;&nbsp;支出</td>
            <td class="zc-sj">¥120</td>
            <td class="zc-sj">¥1500</td>
            <td class="zc-sj">¥20000</td>
        </tr>
    </table>
</div>

        </div>
    </div>
</div>
<?php }} ?>