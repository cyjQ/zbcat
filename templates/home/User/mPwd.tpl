<{include file="Public/header.tpl" title=foo}>
<div class="container">
    <div class="row">
        <{include file="home/User/left.tpl"}>
        <div class="col-sm-9" style="height:auto;padding-bottom: 20px;">
            <div class="container" style="width:100%">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mpwd-title">
                            密码修改
                        </div>
                        <div class="mpwd-uinfo">
                            登录邮箱：<{$user.email}> &nbsp;&nbsp;&nbsp;&nbsp; 会员ID：<{$user.id}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 mpwd-form">
                        <div class="form-div">
                            <form method="post" id="mpwd-form">
                                <div class="form-group">
                                    <label for="email">旧密码：</label>
                                    <input type="text" class="form-control" name="old_pwd">
                                </div>
                                <div class="form-group">
                                    <label for="passwd">密码密码：</label>
                                    <input type="password" class="form-control" name="new_pwd">
                                </div>
                                <div class="form-group">
                                    <label for="email">确认新密码：</label>
                                    <input type="password" class="form-control" name="res_new_pwd">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info mpwd-btn">确认修改</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#mpwd-form').bootstrapValidator({
        message: '这个值没有被验证',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            old_pwd: {
                validators: {
                    notEmpty: {
                        message: '旧密码是必填项'
                    }
                }
            },
            new_pwd: {
                validators: {
                    notEmpty: {
                        message: '新密码是必填项'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '用户名长度在6到16个字符之间'
                    }
                }
            },
            res_new_pwd: {
                validators: {
                    notEmpty: {
                        message: '确认新密码是必填项'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '确认新密码长度在6到16之间'
                    },
                    identical: {
                        field: 'new_pwd',
                        message: '两次密码不同请重新输入'
                    }
                }
            },
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post("./?m=user&c=mpwd_handler", $form.serialize(), function (data) {
            console.log($.parseJSON(data));
            data = $.parseJSON(data);
            if(data.code ==0){
                layer.msg(data.msg,{icon:1,time:1000},function(){
                    location.href =location.href;
                });
            }else{
                layer.msg(data.msg,{icon:5});
            }
        });
    });
</script>
</body>
</html>