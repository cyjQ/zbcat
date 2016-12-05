<nav class="navbar navbar-default login-nav" role="navigation" style="float: left;margin: 0px;padding:0px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle nav-batton" data-toggle="collapse" id="user-change" data-target="#user-nav" style="background: #fff;border: none;">
                    <span class="glyphicon glyphicon-chevron-up" id="user-nav-zs"></span>
                </button>
            </div>
            <div class="col-sm-12 collapse navbar-collapse" style="width: auto;border:none;" id="user-nav">
                <{foreach $user_left_banner as $banner}>
                    <div class="user-nav-p">
                        <div class="user-nav-left-header"><span class="glyphicon glyphicon-user"></span> <{$banner.name}> &nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></div>
                        <ul class="nav nav-pills nav-stacked user-nav-left-ul">
                            <{foreach $banner['subs'] as $vo}>
                               <li <{if $current_left_banner == $vo.id}>style="background:#CEF2B9;"<{/if}>><a href="<{$vo.url}>&current_left_banner=<{$vo.id}>&current_banner=<{$current_banner}>"><{$vo.name}></a></li>
                            <{/foreach}>
                        </ul>
                    </div>
                <{/foreach}>
            </div>
</nav>