<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><{$site_name}></title>
    <script src="<{$__PUBLIC__}>/js/jquery-3.1.1.min.js"></script>
    <link href="<{$__PLUGIN__}>/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<{$__PLUGIN__}>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<{$__PLUGIN__}>/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="<{$__PLUGIN__}>/layer/layer.min.js"></script>
    <link href="<{$__CSS__}>/style.css" rel="stylesheet">
    <link href="<{$__CSS__}>/home/header.css" rel="stylesheet">
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
                <a class="logo" href="/"><img alt="Get ExpressVPN" width="175.133" height="36" src="//xvp.akamaized.net/assets/expressvpn-bc464f48199ec426b9ab9ee289582da7.png">
                </a></div>
            <div class="navbar-collapse collapse" style="height: 1px;">
                <ul class="nav navbar-nav navbar-right">
                            <{foreach $banner as $vo}>
                            <li>
                                <a href="<{$vo.url}>"><{$vo.name}></a>
                            </li>
                            <{/foreach}>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="clear"></div>


