<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="<{$__PUBLIC__}>/js/jquery-3.1.1.min.js"></script>
    <link href="<{$__PLUGIN__}>/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="<{$__PLUGIN__}>/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="<{$__CSS__}>/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-sm-4"><a href="./"> <img src="<{$__IMG__}>home/comiis_logo.gif"/></a></div>
    </div>
</div>
<div class="container login-body-div" style="background: url('<{$__IMG__}>home/login-back.jpg') no-repeat top left;">
    <div class="row">
        <div class="col-sm-12">
            <div class="login-form-parent">
                <div class="login-form-header">
                    login
                </div>
                <div class="login-form-div">
                    <form>
                        <div class="user-name-div">
                            <div class="container" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-12 login-input-parent">
                                        <span class="glyphicon glyphicon-user diy-icon"></span>
                                        <input type="text" name="email" placeholder="请输入注册邮箱">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-pwd-div">
                            <div class="container" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-12 login-input-parent">
                                        <span class="glyphicon glyphicon-lock diy-icon"></span>
                                        <input type="text" name="pwd" placeholder="请输入密码">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default btn-lg login-btn">确认登录</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
