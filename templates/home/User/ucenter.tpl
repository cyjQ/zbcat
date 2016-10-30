<{include file="Public/header.tpl"}>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default login-nav" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" id="user-change" data-target="#user-nav" style="background: #fff;border: none;">
                    <span class="glyphicon glyphicon-chevron-up" id="user-nav-zs"></span>
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
    function scrollx(p) {
        var d = document, dd = d.documentElement, db = d.body, w = window, o = d.getElementById(p.id), ie6 = /msie 6/i.test(navigator.userAgent), style, timer;
        if (o) {
            cssPub = ";position:"+(p.f&&!ie6?'fixed':'absolute')+";"+(p.t!=undefined?'top:'+p.t+'px;':'bottom:0;');
            if (p.r != undefined && p.l == undefined) {
                o.style.cssText += cssPub + ('right:'+p.r+'px;');
            } else {
                o.style.cssText += cssPub + ('margin-left:'+p.l+'px;');
            }
            if(p.f&&ie6){
                cssTop = ';top:expression_r(documentElement.scrollTop +'+(p.t==undefined?dd.clientHeight-o.offsetHeight:p.t)+'+ "px" );';
                cssRight = ';right:expression_r(documentElement.scrollright + '+(p.r==undefined?dd.clientWidth-o.offsetWidth:p.r)+' + "px")';
                if (p.r != undefined && p.l == undefined) {
                    o.style.cssText += cssRight + cssTop;
                } else {
                    o.style.cssText += cssTop;
                }
                dd.style.cssText +=';background-image: url(about:blank);background-attachment:fixed;';
            }else{
                if(!p.f){
                    w.onresize = w.onscroll = function(){
                        clearInterval(timer);
                        timer = setInterval(function(){
                            //双选择为了修复chrome 下xhtml解析时dd.scrollTop为 0
                            var st = (dd.scrollTop||db.scrollTop),c;
                            c = st - o.offsetTop + (p.t!=undefined?p.t:(w.innerHeight||dd.clientHeight)-o.offsetHeight);
                            if(c!=0){
                                o.style.top = o.offsetTop + Math.ceil(Math.abs(c)/10)*(c<0?-1:1) + 'px';
                            }else{
                                clearInterval(timer);
                            }
                        },10)
                    }
                }
            }
        }
    }
    $(document).ready(function () {
        set_user_change();
    });
    function set_user_change(){
        var ini_height = $(window).height()-parseInt($('#user-change').css('height'));
        var ini_left = ($(window).width()-parseInt($('#user-change').css('width')))/2;
        scrollx({id:'user-change', r:ini_left,t:ini_height, f:1});
    }
    $(window).scroll(function () {
        set_user_change();
    });
    $('#user-change').click(function () {
        var html = '<div class="fixed" id="user-nav-p"></div>';
        $('#user-nav').unwrap();
        $('#user-nav').wrap(html);
        var b = $(window).height()- parseInt($('#user-nav-p').css('height'));
        var margin = ($(window).width()-parseInt($('#user-nav').css('width')))/2;
        var show = $('#user-nav').css('display');
        scrollx({id:'user-nav-p', r:0,t:b, f:1});
        $('#user-nav').css('margin-left',margin);
        if(show == 'none'){
            $('#user-nav-p').css('display','block');
            $('#user-nav-zs').prop('class','glyphicon glyphicon-chevron-down');
            $('#user-change').css('position','absolute');
            $('#user-change').css('top',b-40);
            $('#user-change').css('left',($(window).width()-parseInt($('#user-change').css('width')))/2);
        }else{
            $('#user-nav-p').css('display','none');
            $('#user-nav-zs').prop('class','glyphicon glyphicon-chevron-up');
            $('#user-change').css('position','absolute');
            $('#user-change').css('top',$(window).height()-parseInt($('#user-change').css('height')));
            $('#user-change').css('left',($(window).width()-parseInt($('#user-change').css('width')))/2);
        }
    });
</script>