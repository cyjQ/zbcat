<{include file="Public/header.tpl" title=foo}>
<link href="<{$__CSS__}>/home/index.css" rel="stylesheet">
<link href="<{$__CSS__}>/home/nigran.datepicker.css" rel="stylesheet">
<link href="<{$__CSS__}>/home/jquery-ui-1.10.1.css" rel="stylesheet">
<script src="<{$__JS__}>jquery-ui-1.10.1.min.js"></script>
<script>
    $(function() {
        $( ".datepicker" ).datepicker({
            inline: true,
            showOtherMonths: true
        });
    });
</script>
<!--中间横幅start-->
<div class="container" id="banner_div">
    <div class="row">
        <div class="col-sm-5 banner_left">
            <div class="logo_site_name">
                <img src="<{$__IMG__}>home/logo_site_name.png"/>
            </div>
            <div class="site-discription">
                你是月光族吗?这个月的钱花到那里去了?你还在为日常开销混乱烦恼吗?<br/>
                网上购物,除了淘宝和天猫等,你还知道那些实惠品质的购物网站?<br/>
                你是一个乐于分享的人吗?想找一些朋友分享你的快乐吗?<br/>
                如果是,那就加入我们吧!!
            </div>
            <div class="button-div">
                <a class="btn btn-lg btn-primary">登录</a>
                <a class="btn btn-lg btn-primary" style="background: #ffff00;margin-left: 50px;color:#ff0000;">注册</a>
            </div>
        </div>
        <div class="col-sm-3 banner_left">
            <div class="city">呼和浩特&nbsp;&nbsp;<span>[切换城市]</span></div>
            <div class="weather">
                <div><img src="<{$__IMG__}>home/weather2.jpg"/></div>
                <div class="weather-text">多云</div>
            </div>
            <div class="time" id="show_time"><span class="glyphicon glyphicon-time"></span> 12:03:05</div>
        </div>
        <div class="col-sm-4 hidden-xs">
            <article >
                <table class="datepickers-cont" style="height: 393px;">
                    <tr>
                        <td class="part">
                            <div class="datepicker ll-skin-nigran"></div>
                        </td>
                    </tr>
                </table>
            </article>
        </div>
    </div>
</div>
<!--中间横幅end-->
<div class="container">
    <div class="row">
        <div class="what-we-do">
            <div class="work-descripion">
                <img src="<{$__IMG__}>/home/cat.jpg" class="what-do-img"/>
                我们可以为您做什么?
            </div>
        </div>
    </div>
</div>
<div class="container person-model-div">
    <div class="row">
        <div class="col-sm-4 person-model"><img src="<{$__IMG__}>/home/perso1.jpg" class="person">
            我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫
        </div>
        <div class="col-sm-4 person-model"><img src="<{$__IMG__}>/home/perso1.jpg" class="person">
            我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝
        </div>
        <div class="col-sm-4 person-model"><img src="<{$__IMG__}>/home/perso1.jpg" class="person">
            我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用抓宝猫我在实用
        </div>
    </div>
</div>
<script>
    $(function(){
        setInterval(show_time,1000);
    })
    function show_time(){
        var time = new Date();
        var hours = format_time(time.getHours());
        var mini = format_time(time.getMinutes());
        var s = format_time(time.getSeconds());
        timestr = '<span class="glyphicon glyphicon-time"></span>  '+hours + ':' +mini +':'+ s;
        $('#show_time').html(timestr);
    }

    function format_time(time){
        if(time<10){
            return '0'+time;
        }
        return time;
    }
</script>

