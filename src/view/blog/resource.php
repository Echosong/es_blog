<!-- 主体（一般只改变这里的内容） -->
    <div class="blog-body">
        <div class="blog-container">
            <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow">
                <a href="home.html" title="网站首页">网站首页</a>
                <a><cite>资源分享</cite></a>
            </blockquote>
            <div class="blog-main">
                <div class="blog-main">

                    <div class="resource-main">
                        <?php foreach ($posts as $post) { ?>

                        <div class="resource shadow">
                            <div class="resource-cover">
                                <a href="<?=$post['url']?> " target="_blank">
                                    <img src="<?=$post['image']?> " />
                                </a>
                            </div>

                            <p class="resource-abstract"><?=$post['title']?>！</p>
                            <div class="resource-info">
                                <span class="category"><a href="#"><i class="fa fa-tags fa-fw"></i>&nbsp;源码</a></span>
                                <span class="author"><i class="fa fa-user fa-fw"></i>Echosong</span>
                                <div class="clear"></div>
                            </div>
                            <div class="resource-footer">
                                <a class="layui-btn layui-btn-small layui-btn-primary" href="#" target="_blank"><i class="fa fa-eye fa-fw"></i>演示</a>
                                <a class="layui-btn layui-btn-small layui-btn-primary" href="<?=$post['url']?>" target="_blank"><i class="fa fa-download fa-fw"></i>下载</a>
                            </div>
                        </div>
                      <?php } ?>
                        <!-- 清除浮动 -->
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>