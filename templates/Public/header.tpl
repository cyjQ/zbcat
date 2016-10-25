<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>抓宝猫财务管家</title>
    <link href="{$__PLUGIN__}/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="{$__PLUGIN__}/bootstrap/js/jquery-2.1.3.min.js"></script>
    <script src="{$__PLUGIN__}/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{$__PLUGIN__}/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <link href="{$__CSS__}/style.css" rel="stylesheet">
</head>
<body>
<div class="container logo-header">
    <div class="row top-header">&nbsp;</div>
    <div class="row">
        <div class="col-sm-4"><img src="{$__IMG__}home/comiis_logo.gif"/></div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-1" style="padding-top: 10px;">
                    {foreach $text_message as $vo}
                    <div class="youshi-detail-text">
                        <div style="height: 10px;width: 10px;"></div>
                        {$vo}
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
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
                {foreach $banner as $vo}
                <li><a href="{$vo.url}">{$vo.name}</a></li>
                {/foreach}
            </ul>
        </div>
        <div class="email">
           <a><img src="{$__IMG__}home/envelope.gif">&nbsp;359889053@qq.com</a>
        </div>
    </nav>
</div>


