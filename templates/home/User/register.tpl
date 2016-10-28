<{include file="Public/header.tpl" title=foo}>
<div class="container">
    <div class="row register-row">
        <div class="col-sm-6">
            <div class="register-div">
                <div class="register-text">
                    CREATE AN ACCOUNT
                </div>
                <div class="form-div">
                    <form method="post" id="registerForm">
                        <div class="form-group">
                            <label for="email">用户名：*</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱：*</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="passwd">密码：*</label>
                            <input type="password" class="form-control" name="pwd">
                        </div>
                        <div class="form-group">
                            <label for="email">确认密码：*</label>
                            <input type="password" class="form-control" name="repwd">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default btn-lg register-btn" style="width: 100%;">Register Now!</button>
                        </div>
                    </form>
                </div>
           </div>

     </div>
        <div class="col-sm-6 register-div-right">
            <nav class="navbar navbar-default login-nav" role="navigation">
                <div class="navbar-header" style="position: absolute;top:-300px;right:-30px;">
                    <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" data-target="#data-register-right" style="width: 40px;" id="chang-login-div">
                        已有账号<br/>？
                    </button>
                </div>
                <div class=" collapse navbar-collapse" id="data-register-right">
                    <div class="register-login-div row">
                        <div class="col-sm-12" style="text-align: center;margin-bottom: 10px;">
                            已有账号？
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-default btn-lg" style="background: #90B75A;color: #fff;" href="./?m=user&c=login">马上登陆</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<script>
    $('#chang-login-div').click(function(){
        $('.register-login-div').prop('class','postion-absolute');

    })
    $('#registerForm').bootstrapValidator({
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
            username: {
                validators: {
                    notEmpty: {
                        message: '用户名是必填项'
                    },
                    stringLength: {
                        min: 2,
                        max: 7,
                        message: '用户名长度在2到7个字符之间'
                    }
                }
            },
            pwd: {
                validators: {
                    notEmpty: {
                        message: '密码是必填项'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '密码长度在6到16之间'
                    },
                }
            },
            repwd: {
                validators: {
                    notEmpty: {
                        message: '确认密码是必填项'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '确认密码长度在6到16之间'
                    },
                    identical: {
                        field: 'pwd',
                        message: '两次密码不同请重新输入'
                    }
                }
            },
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post("./?m=user&c=register_handler", $form.serialize(), function (data) {
            console.log($.parseJSON(data));
            data = $.parseJSON(data);
            if(data.code ==0){
                location.href= './?m=user&c=success_register'
            }else{
                layer.msg(data.msg,{icon:2});
            }
        });
    });
</script>
<{include file="Public/footer.tpl" title=foo}>