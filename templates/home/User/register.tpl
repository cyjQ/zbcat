{include file="Public/header.tpl" title=foo}
<div class="container">
    <div class="row register-row">
        <div class="col-sm-6 register-div">
            <div class="register-text">
                CREATE AN ACCOUNT
            </div>
            <div class="form-div">
                <form method="post" id="registerForm">
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
</div>
<script>
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
        $.post("/Account/Register", $form.serialize(), function (data) {
            console.log(data)
            if (data.Status == "ok") {
                window.location.href = "/Home/Index";
            }
            else if (data.Status == "error") {
                alert(data.Message);
            }
            else {
                alert("未知错误");
            }
        });
    });
</script>
{include file="Public/footer.tpl" title=foo}