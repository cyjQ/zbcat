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
    <script src="<{$__PLUGIN__}>/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="<{$__PLUGIN__}>/layer/layer.min.js"></script>
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
                    <form method="post" id="login-form">
                        <div class="user-name-div">
                            <div class="container" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-12 login-input-parent">
                                        <div class="form-group">
                                             <span class="glyphicon glyphicon-user diy-icon"></span>
                                             <input type="text" name="email" placeholder="请输入注册邮箱">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-pwd-div">
                            <div class="container" style="width: 100%;">
                                <div class="row">
                                    <div class="col-sm-12 login-input-parent">
                                        <div class="form-group">
                                            <span class="glyphicon glyphicon-lock diy-icon"></span>
                                            <input type="password" name="pwd" placeholder="请输入密码">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default btn-lg login-btn">确认登录</button>
                    </form>
                    <div class="forget-pwd-div">
                        <div class="forget-pwd-div1">
                            <a href="#">忘记密码<span class="glyphicon glyphicon-question-sign"></span> </a>
                        </div>
                        <div class="forget-pwd-div2">
                            <a href="./?m=user&c=register">还没有账号<span class="glyphicon glyphicon-question-sign"></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $('#login-form').bootstrapValidator({
        message: '这个值没有被验证',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: '邮箱是必填项'
                    },
                    emailAddress: {
                        message: '邮箱格式错误'
                    }
                }
            },
            pwd: {
                validators: {
                    notEmpty: {
                        message: '密码是必填项'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post("./?m=user&c=login_handler", $form.serialize(), function (data) {
            console.log($.parseJSON(data));
            data = $.parseJSON(data);
            if(data.code ==0){
                layer.msg(data.msg,{icon:1});
            }else{
                layer.msg(data.msg,{icon:2});
            }
        });
    });
</script>
</body>
</html>
