<?php

$config = array(
    'rewrite' => array(
        //设置模块 碰到 http://{host}/admin/ 认为进入了后台模块 数组 0 标识默认 m
        'm' => ['blog', 'admin'],
        'c' => 'main', //controller 命名一定不能合 m 命名相同否则路由  m 有限会算作模块
        'a' => 'home', //action 默认值,
        'isRewrite' => true //是否开启伪静态 .htaccess 文件配置
    ),
    'debug' => true,
    'plugins' => ['include', 'plugin'], //扩展目录
    'static' => "res",
    'logPath' => 'logs' //日志路径，请保证路径权限可写
);

$dbb = array(
    'mysql' => [
        //主库
        'master' => [
            'MYSQL_HOST' => '127.0.0.1',
            'MYSQL_PORT' => '3306',
            'MYSQL_USER' => 'root',
            'MYSQL_DB' => 'db_beego',
            'MYSQL_PASS' => '',
            'MYSQL_CHARSET' => 'utf8',
        ],
        //从库可以加入多个实例
        'slave' => [
            'MYSQL_HOST' => '127.0.0.1',
            'MYSQL_PORT' => '3306',
            'MYSQL_USER' => 'root',
            'MYSQL_DB' => 'db_beego',
            'MYSQL_PASS' => '',
            'MYSQL_CHARSET' => 'utf8',
        ]
    ],
    'prefix' => 'tb_',
);

//composer 扩展
$app = [
    'redis'=>[
        'server' => '192.168.1.61:6379',
        'timeout' => 2,
        'password' => 'songfeiok',
        'database' => 3
    ],
];


return $dbb + $config + $app;
