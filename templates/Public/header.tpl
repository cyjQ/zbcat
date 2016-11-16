<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>抓宝猫财务管家</title>
    <script src="<{$__PUBLIC__}>/js/jquery-3.1.1.min.js"></script>
    <link href="<{$__PLUGIN__}>/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<{$__PLUGIN__}>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<{$__PLUGIN__}>/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="<{$__PLUGIN__}>/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
    <link href="<{$__PLUGIN__}>/clockpicker/dist/bootstrap-clockpicker.min.css" rel="stylesheet">
    <script src="<{$__PLUGIN__}>/layer/layer.min.js"></script>
    <script src="<{$__PUBLIC__}>/js/jquery.sticky.elements.js"></script>
    <link href="<{$__CSS__}>/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container logo-header">
    <div class="row top-header">&nbsp;</div>
    <div class="row">
        <div class="col-sm-4"><img src="<{$__IMG__}>home/comiis_logo.gif"/></div>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-1" style="padding-top: 10px;width: 405px;">
                    <{foreach $text_message as $vo}>
                    <div class="youshi-detail-text">
                        <div style="height: 10px;width: 10px;"></div>
                        <{$vo}>
                    </div>
                    <{/foreach}>
                </div>
            </div>
        </div>
        <div class="col-sm-3 user-div" style="height: 60px;padding: 0px;">
            <div class="user-avater">
                <img src="<{$__IMG__}>home/noavatar_small.gif" class="img-responsive">
            </div>
            <div class="user-name">
                <div style="height: 48%">欢迎你：<span class="name"><{$smarty.session.username}></span> | <a href="./?m=user&c=login_out"> 退出 </a></div>
                <div style="height: 48%">
                    2016.10.26
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <nav class="navbar navbar-default nav-nav" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" data-target="#example-navbar-collapse" >
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse nav-div" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <{foreach $banner as $vo}>
                <li><a href="<{$vo.url}>"><{$vo.name}></a></li>
                <{/foreach}>
            </ul>
        </div>
        <div class="email" title="反馈建议">
           <a><img src="<{$__IMG__}>home/envelope.gif">&nbsp;359889053@qq.com</a>
        </div>
    </nav>
</div>


