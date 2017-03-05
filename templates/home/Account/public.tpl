<{include file="Public/header.tpl" title=foo}>
<link href="<{$__CSS__}>/home/account.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-sm-4 right">
            <div class="user_account_info">
                <div class="account_user_avatar">
                    <img class="user-avater" src="<{$__IMG__}>home/perso1.jpg">
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
            <{block name="content"}>default content<{/block}>
        </div>
    </div>
</div>
