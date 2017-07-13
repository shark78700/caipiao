<?php
return array(
	//'配置项'=>'配置值'

    'DB_TYPE'=>'mysql', //数据库类型
    'DB_USER'=>'root', //用户名
    'DB_PWD'=>'root', //密码
    'DB_PREFIX'=>'bocai_', //数据库表前缀
    'DB_DSN'=>'mysql:host=localhost;dbname=caipiao;charset=UTF8',

    'TMPL_L_DELIM'=>'{{',
    'TMPL_R_DELIM'=>'}}',
    /*图片插件的使用，让I函数不过滤*/
    'DEFAULT_FILTER'  =>  '',
    'SHOW_PAGE_TRACE' =>true,
);