<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=gb2312">
    <meta http-equiv="Content-Language" content="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="Keywords" content=" <?=$config["keywords"] ?> ">
    <meta name="Description" content="<?=$config["description"] ?>">
    <title><?=$routes["a"]?>-<?=$config["title"] ?></title>
    <link rel="shortcut icon" href="/res/images/f.ico" type="image/x-icon">
    <!--Layui-->
    <link href="/res/plug/layui/css/layui.css" rel="stylesheet" />
    <!--font-awesome-->
    <link href="/res/plug/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--全局样式表-->
    <link href="/res/css/global.css" rel="stylesheet" />
    <!-- 本页样式表 -->
    <link href="/res/css/<?=$routes['a']?>.css" rel="stylesheet" />
    <!-- layui.js -->
    <script src="/res/plug/layui/layui.js"></script>
    <script src="/res/js/jquery.min.js"></script>
    <!-- 全局脚本 -->
    <script src="/res/js/global.js"></script>
    <script src="/res/js/<?=$routes['a']?>.js"></script>
</head>
<body>
<!-- 导航 -->
<nav class="blog-nav layui-header">
    <div class="blog-container">
        <!-- QQ互联登陆 -->
        <a href="javascript:;" class="blog-user">
            <i class="fa fa-qq"></i>
        </a>
        <a href="javascript:;" class="blog-user layui-hide">
            <img src="/res/images/Absolutely.jpg" alt="Absolutely" title="Absolutely" />
        </a>
        <!-- 不落阁 -->
        <a class="blog-logo" href="home.html">ES-博客</a>
        <!-- 导航菜单 -->
        <ul class="layui-nav" lay-filter="nav">
            <li class="layui-nav-item  <?php if($routes['a']=="home") echo "layui-this"; ?>" >
                <a href="/"><i class="fa fa-home fa-fw"></i>&nbsp;网站首页</a>
            </li>
            <li class="layui-nav-item <?php if($routes['a']=="article" || $routes['a']=="detail") echo "layui-this"; ?>" >
                <a href="<?=Helper::url('main', 'article')?>"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
            </li>
            <li class="layui-nav-item <?php if($routes['a']=="resource") echo "layui-this"; ?> ">
                <a href="<?=Helper::url('main', 'resource')?>"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
            </li>
            <li class="layui-nav-item <?php if($routes['a']=="timeline") echo "layui-this"; ?>">
                <a href="<?=Helper::url('main', 'timeline')?>"><i class="fa fa-hourglass-half fa-fw"></i>&nbsp;点点滴滴</a>
            </li>
            <li class="layui-nav-item <?php if($routes['a']=="about") echo "layui-this"; ?> ">
                <a href="<?=Helper::url('main', 'about')?>"><i class="fa fa-info fa-fw"></i>&nbsp;关于本站</a>
            </li>
        </ul>
        <!-- 手机和平板的导航开关 -->
        <a class="blog-navicon" href="javascript:;">
            <i class="fa fa-navicon"></i>
        </a>
    </div>
</nav>



<?php include $__render_body?>
<footer class="blog-footer">
    <p><span>Copyright</span><span>&copy;</span><span>2017</span><a href="{{.config.url}}">{{.config.title}}</a><span>Design By LY</span></p>
    <p><a href="http://www.miibeian.gov.cn/" target="_blank">沪ICP备xxxx号-1</a></p>
</footer>

<!--侧边导航-->
<ul class="layui-nav layui-nav-tree layui-nav-side blog-nav-left layui-hide" lay-filter="nav">
    <li class="layui-nav-item layui-this">
        <a href="home.html"><i class="fa fa-home fa-fw"></i>&nbsp;网站首页</a>
    </li>
    <li class="layui-nav-item">
        <a href="article.html"><i class="fa fa-file-text fa-fw"></i>&nbsp;文章专栏</a>
    </li>
    <li class="layui-nav-item">
        <a href="resource.html"><i class="fa fa-tags fa-fw"></i>&nbsp;资源分享</a>
    </li>
    <li class="layui-nav-item">
        <a href="timeline.html"><i class="fa fa-road fa-fw"></i>&nbsp;点点滴滴</a>
    </li>
    <li class="layui-nav-item">
        <a href="about.html"><i class="fa fa-info fa-fw"></i>&nbsp;关于本站</a>
    </li>
</ul>
<!--分享窗体-->
<div class="blog-share layui-hide">
    <div class="blog-share-body">
        <div style="width: 200px;height:100%;">
            <div class="bdsharebuttonbox">
                <a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                <a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                <a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
            </div>
        </div>
    </div>
</div>
<!--遮罩-->
<div class="blog-mask animated layui-hide"></div>


</body>
</html>
