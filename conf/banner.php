<?php
return array(
    'Banner'=>array(
        array('id'=>1,'name'=>'首页','url'=>'./'),
        array('id'=>3,'name'=>'广场','url'=>'#'),
        array('id'=>2,'name'=>'个人中心','url'=>'./?m=user&c=ucenter&current_banner=2'),
        array('id'=>6,'name'=>'关于我们','url'=>'#'),
    ),
    'Text_message'=>array(
        '简单实用',
        '贴心生活',
        '轻松分享',
    ),

    //个人中心左侧导航
    'UserCenter'=>array(
        array('name'=>'个人信息','subs'=>array(
            array('name'=>'个人资料','id'=>1,'url'=>'./?m=user&c=ucenter'),
            array('name'=>'修改密码','id'=>2,'url'=>'./?m=user&c=mPwd')
        )),
        array('name'=>'记账信息','subs'=>array(
            array('name'=>'添加账单','id'=>3,'url'=>''),
            array('name'=>'总账概况','id'=>4,'url'=>''),
            array('name'=>'记账科目','id'=>5,'url'=>''),
        )),
        array('name'=>'社区信息','subs'=>array(
            array('name'=>'我的发表','id'=>6,'url'=>''),
            array('name'=>'与我相关','id'=>7,'url'=>''),
        ))
    )

);