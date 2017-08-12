<div class="blog-body">
    <!-- canvas -->
    <canvas id="canvas-banner" style="background: #393D49;"></canvas>
    <!--为了及时效果需要立即设置canvas宽高，否则就在home.js中设置-->
    <script type="text/javascript">
        var canvas = document.getElementById('canvas-banner');
        canvas.width = window.document.body.clientWidth - 10;//减去滚动条的宽度
        if (screen.width >= 992) {
            canvas.height = window.innerHeight * 1 / 3;
        } else {
            canvas.height = window.innerHeight * 2 / 7;
        }
    </script>
    <!-- 这个一般才是真正的主体内容 -->
    <div class="blog-container">
        <div class="blog-main">
            <!--左边文章列表-->
            <div class="blog-main-left">

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
                    <?= pager ?>
                </div>
            </div>
            <!--右边小栏目-->
            <div class="blog-main-right">
                <div class="blogerinfo shadow">
                    <div class="blogerinfo-figure">
                        <img src="/res/images/es.png" alt="Echosong"
                             style="width: 100px; height: 100px; border-color: papayawhip; border: 1px solid;"/>
                    </div>
                    <p class="blogerinfo-nickname">Echsong</p>
                    <p class="blogerinfo-introduce">太阳底下没有新鲜事</p>
                    <p class="blogerinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;上海 - 浦东</p>
                    <hr/>
                    <div class="blogerinfo-contact">
                        <a target="_blank" title="QQ交流" href="javascript:layer.msg('启动QQ会话窗口')"><i
                                    class="fa fa-qq fa-2x"></i></a>
                        <a target="_blank" title="给我写信" href="javascript:layer.msg('启动邮我窗口')"><i
                                    class="fa fa-envelope fa-2x"></i></a>
                        <a target="_blank" title="新浪微博" href="javascript:layer.msg('转到你的微博主页')"><i
                                    class="fa fa-weibo fa-2x"></i></a>
                        <a target="_blank" title="码云" href="https://github.com/Echosong/ES/"><i
                                    class="fa fa-git fa-2x"></i></a>
                    </div>
                </div>
                <div></div><!--占位-->

                <div class="article-category shadow">
                    <div class="article-category-title">分类导航</div>
                    <?php foreach ($cates as $cate) { ?>
                        <a href=" <?= Helper::url('blog', 'article',
                            ['cate_id' => $cate['id']]) ?>"><?= $cate['name'] ?></a>
                    <?php } ?>
                    <div class="clear"></div>
                </div>

                <div class="blog-module shadow">
                    <div class="blog-module-title">热文排行</div>
                    <ul class="fa-ul blog-module-ul">
                        <?php foreach ($hosts as $host) { ?>
                            <li style="line-height: 30px"><i class="fa-li fa fa-hand-o-right"></i><a
                                        href="<?= Helper::url('blog', 'detail',
                                            ['id' => $host['id']]) ?>"><?= $host['title'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="blog-module shadow">
                    <div class="blog-module-title">友情链接</div>
                    <ul class="blogroll">
                        <li><a target="_blank" href="http://www.layui.com/" title="Layui">Layui</a></li>
                        <li><a target="_blank" href="https://github.com/Echosong/ES/" title="页签">github</a></li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

