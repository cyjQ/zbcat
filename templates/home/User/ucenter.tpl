<{include file="Public/header.tpl"}>
<div class="container">
    <div class="row">
        <{include file="home/User/left.tpl"}>
        <div class="col-sm-9" style="padding-top: 0px;">
            <div class="container" style="width: 100%";>
                <div class="row">
                    <div class="col-sm-3 user-avater-div">
                        <img src="<{$__IMG__}>home/noavatar_small.gif">
                    </div>
                    <div class="col-sm-9" style="height: 160px;">
                        <div class="container" style="width: 100%">
                            <div class="row">
                                <div class="col-sm-12" style="padding: 0px;">
                                    <span class="center-user-name">飘逝的雪花</span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="ucenter-info">注册时间：2016-9-54</div>
                                <div class="ucenter-info">上次登录时间：2016-9-54</div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="ucenter-info">本次登录IP：2016-9-54</div>
                                <div class="ucenter-info">上次登录时间：2016-9-54</div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <a class="btn btn-info btn-default" style="width: 90px;"><span class="glyphicon glyphicon-open">上传头像</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row user-info-div" style="height:auto;border-top:2px dotted #d5d5d5;border-bottom: 2px dotted #d5d5d5;padding-bottom: 20px;">
                    <h4>其他信息</h4>
                    <div class="col-lg-6 col-lg-offset-1">
                        <div class="form-group form-inline user-info-input" >
                            <label for="email" class="col-sm-4">电子邮箱：</label>
                            <input type="text" name="email">
                        </div>
                        <div class="form-group form-inline user-info-input" >
                            <label for="email" class="col-sm-4">手机：</label>
                            <input type="text" name="phone">
                        </div>
                        <div class="form-group form-inline user-info-input">
                            <label for="email" class="col-sm-4">电子邮箱：</label>
                            <input type="text" name="email">
                        </div>
                        <div class="form-group form-inline user-info-input">
                            <label for="email" class="col-sm-4">生日：</label>
                            <input type="date" name="birthday">
                        </div>
                        <div class="form-group form-inline user-info-input">
                            <label for="email" class="col-sm-4">居住地：</label>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-lg-offset-1">
                        <button class="btn  btn-info" style="margin:20px 0px;">保存</button>
                    </div>
                </div>


            </div>
        </div>
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