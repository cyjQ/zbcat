<?php
return array(
    /*'appid'=>'wxaa4b801f078824e5',
    'secret'=>'6aee5f3f76cf1966314fe14c87eeceda',*/
    // 'token'=>'zbcat_cyj',
    'appid'=>'wx7462464a8a54147f',
    'secret'=>'6647f070f55a3669785b7527f95129e6',
    'token'=>'cyj123',

    //微信的自定义菜单设置
    'menu'=>array(
        'button'=>array(
            array(
                'name'=>'个人中心',
                'type'=>'click',
                'key'=>'ucenter'
            ),
            array(
                'name'=>'官方网站',
                'type'=>'view',
                'url'=>'http://www.zhuabaobmao.com'
            ),
            array(
                'name'=>'我的账单',
                'sub_button'=>array(
                    array(
                        'type'=>'view',
                        'name'=>'总账概览',
                        'url'=>'http://www.zhuabaobmao.com/?m=user&c=ucenter'
                    ),
                    array(
                        'type'=>'view',
                        'name'=>'本月详情',
                        'url'=>'http://www.zhuabaobmao.com/?m=user&c=ucenter'
                    )
                )
            )
        )
    )

);