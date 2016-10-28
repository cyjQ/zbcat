<{include file="Public/header.tpl"}>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default login-nav" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" id="user-change" data-target="#user-nav" style="width: 40px;">
                    已有账号<br/>？
                </button>
            </div>
            <div class="col-sm-3 collapse navbar-collapse" style="width: auto;border:none" id="user-nav">
                <div class="user-nav-p">
                    <div class="user-nav-left-header"><span class="glyphicon glyphicon-user"></span> 个人信息 &nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></div>
                    <ul class="nav nav-pills nav-stacked user-nav-left-ul">
                        <li><a href="#">个人资料</a></li>
                        <li><a href="#">修改密码</a></li>
                    </ul>
                </div>
                <div class="user-nav-p">
                    <div class="user-nav-left-header"><span class="glyphicon glyphicon-list-alt"></span> 记账信息 &nbsp;&nbsp;<span class="glyphicon glyphicon-minus"></span> </div>
                    <ul class="nav nav-pills nav-stacked user-nav-left-ul">
                        <li><a href="#">添加账单</a></li>
                        <li><a href="#">总账概况</a></li>
                        <li><a href="#">总账概况</a></li>
                        <li><a href="#">记账科目</a></li>
                    </ul>
                </div>
                <div class="user-nav-p">
                    <div class="user-nav-left-header"><span class="glyphicon glyphicon-home"></span> 社区信息 &nbsp;&nbsp;<span class="glyphicon glyphicon-minus"></span></div>
                    <ul class="nav nav-pills nav-stacked user-nav-left-ul">
                        <li><a href="#">添加账单</a></li>
                        <li><a href="#">收入明细</a></li>
                        <li><a href="#">支出明细</a></li>
                        <li><a href="#">记账科目</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
    $('.user-nav-left-header').click(function () {
        var display = $(this).next().css('display');
        if(display == 'block'){
            $(this).next().css('display','none');
            $(this).children('span').eq(1).prop('class','glyphicon');
            $(this).children('span').eq(1).prop('class','glyphicon-plus');
        }else if(display == 'none'){
            $(this).next().css('display','block');
            $(this).children('span').eq(1).prop('class','glyphicon');
            $(this).children('span').eq(1).prop('class','glyphicon-minus');
        }
    });
    $('#user-change').click(function () {
        var html = '<div class="fixed" id="user-nav-p"></div>';
        $('#user-nav').unwrap();
        $('#user-nav').wrap(html);
    });
</script>