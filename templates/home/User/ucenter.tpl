<{include file="Public/header.tpl"}>
<script src="<{$__PLUGIN__}>bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<link href="<{$__PLUGIN__}>bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <{include file="home/User/left.tpl"}>
        <div class="col-sm-9" style="padding-top: 0px;">
            <div class="container" style="width: 100%";>
                <div class="row">
                    <div class="col-sm-3 user-avater-div">
                        <{if $user['avatar']}>
                            <img src="<{$user.avatar}>" class="img-responsive">
                        <{else}>
                            <img src="<{$__IMG__}>home/noavatar_small.gif" class="img-responsive">
                        <{/if}>
                    </div>
                    <div class="col-sm-9" style="height: 160px;">
                        <div class="container" style="width: 100%">
                            <div class="row">
                                <div class="col-sm-12" style="padding: 0px;">
                                    <span class="center-user-name"><{$user.username}></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="ucenter-info">注册时间：<{$user.create_time|date_format:"Y/m/d"}></div>
                                <div class="ucenter-info">上次登录时间：<{$user.last_login_time|date_format:"Y/m/d H:i"}></div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="ucenter-info">本次登录IP：<{$smarty.session.login_ip}></div>
                                <div class="ucenter-info">上次登录时间：2016-9-54</div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <a class="btn btn-info btn-default visible-xs" style="width: 90px;" id="set-avatar-ph"><span class="glyphicon glyphicon-open">上传头像</span> </a>
                                <a class="btn btn-info btn-default hidden-xs" style="width: 90px;" id="set-avatar-pc"><span class="glyphicon glyphicon-open">上传头像</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row user-info-div" style="height:auto;border-top:2px dotted #d5d5d5;border-bottom: 2px dotted #d5d5d5;padding-bottom: 20px;">
                    <h4>其他信息</h4>
                    <form id="user-form">
                        <div class="col-lg-6 col-lg-offset-1">
                            <div class="form-group form-inline user-info-input" >
                                <label for="email" class="col-sm-4">电子邮箱：</label>
                                <input type="text" name="email" value="<{$user.email}>" disabled>
                            </div>
                            <div class="form-group form-inline user-info-input" >
                                <label for="email" class="col-sm-4">手机：</label>
                                <input type="text" name="phone" value="<{$user.phone}>">
                            </div>
                            <div class="form-group form-inline user-info-input">
                                <label for="email" class="col-sm-4">性别：</label>
                                <input type="radio" value="1"  name="sex"<{if $user.sex == 1 }> checked<{/if}>> 男   &nbsp;&nbsp;&nbsp;<input name='sex' type="radio" value="0"<{if $user.sex == 0 }>checked<{/if}>> 女
                            </div>
                            <div class="form-group form-inline user-info-input">
                                <label for="email" class="col-sm-4">生日：</label>
                                <input type="text" value="<{$user.birthday|date_format:"Y/m/d"}>" id="birthday" name="birthday" data-date-format="yyyy/mm/dd">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-lg-offset-1">
                        <button class="btn  btn-info" style="margin:20px 0px;" id="user-save">保存</button>
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
    $.fn.datetimepicker.dates['zh'] = {
        days:       ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六","星期日"],
        daysShort:  ["日", "一", "二", "三", "四", "五", "六","日"],
        daysMin:    ["日", "一", "二", "三", "四", "五", "六","日"],
        months:     ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月","十二月"],
        monthsShort:  ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],
        meridiem:    ["上午", "下午"],
        //suffix:      ["st", "nd", "rd", "th"],
        today:       "今天"
    };

    $('#birthday').datetimepicker({
        language:  'zh',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView:2,
        forceParse: 0,
        showMeridian: 1,
        maxView:4
    });

    /*提交保存用户信息*/
    $('#user-save').click(function(){
        if($('input[name="phone"]').val() !=''){
            var phone_preg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            var tel = $('input[name="phone"]').val();
            if(!phone_preg.test(tel)){
                layer.tips('请输入有效的手机号码', $('input[name="phone"]'), {
                    tips: [2, '#1ab394']
                });
                return false;
            }
        }
        $.post("./?m=user&c=save_info", $('#user-form').serialize(), function (data) {
            console.log($.parseJSON(data));
            data = $.parseJSON(data);
            if(data.code==0){
                layer.msg(data.msg,{icon:1,time:1000},function () {
                    location.reload();
                });
            }else{
                layer.msg(data.msg,{icon:5,time:1000});
            }
        });
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
        var arg = { };
        arg.url = location.href.split('#')[0];
        $.ajax({
            method:'get',
            url:'./?m=wxchat&c=getJssdkConfig',
            data:arg,
            success:function(res){
                var conf = $.parseJSON(res);
                console.log(conf);
                wx.config({
                    debug: true,
                    appId: conf.appId,
                    timestamp: conf.timestamp,
                    nonceStr:conf.nonceStr,
                    signature:conf.signature,
                    jsApiList:[
                        "chooseImage"
                    ]
            });
            }
        });
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
    $('#set-avatar-pc').click(function(){
        layer.open({
            type:2,
            title:'头像设置',
            area:['800px','500px'],
            content:['./?m=user&c=set_avatar_pc','no'],
            shift: 2,
            end:function () {
                location.reload();
            }
        });
    });
    $('#set-avatar-ph').click(function(){
        layer.open({
            type:1,
            title:'头像设置',
            area:['300px','200px'],
            content:'aa'
        });
    });

    function choseImage(){
        var localId;
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片

            }
        });
    }
</script>