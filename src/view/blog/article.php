
    <!-- 主体（一般只改变这里的内容） -->
    <div class="blog-body">
        <div class="blog-container">
            <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow">
                <a href="home.html" title="网站首页">网站首页</a>
                <a><cite>文章专栏</cite></a>
            </blockquote>
            <div class="blog-main">
                <div class="blog-main-left">
                    <div class="shadow" style="text-align:center;font-size:16px;padding:40px 15px;background:#fff;margin-bottom:15px;">
                        未搜索到与【<span style="color: #FF5722;">keywords</span>】有关的文章，随便看看吧！
                    </div>
                    <?php foreach ($posts as $post) { ?>
                        <div class="article shadow">
                            <div class="article-left">
                                <img src="<?= $post['image'] ?>"/>
                            </div>
                            <div class="article-right">
                                <div class="article-title">
                                    <a href="<?= Helper::url('main', 'detail',
                                        ['id' => $post['id']]) ?>"><?= $post['title'] ?></a>
                                </div>
                                <div class="article-abstract">
                                    <?= $post['info'] ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="article-footer">
                                <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp; <?= $post['updated'] ?></span>
                                <span class="article-author"><i class="fa fa-user"></i>&nbsp;&nbsp;Echosong</span>
                                <span><i class="fa fa-tag"></i>&nbsp;&nbsp;<a href="#"><?= $post['tags'] ?> </a></span>
                                <span class="article-viewinfo"><i class="fa fa-eye"></i><?= $post['views'] ?></span>
                                <span class="article-viewinfo"><i
                                            class="fa fa-commenting"></i>&nbsp;<?= $post['comments'] ?></span>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
                        {{str2html .pagebar}}
                    </div>

                </div>
                <?php include  $template_dir."/right.php" ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>