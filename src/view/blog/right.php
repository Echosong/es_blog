<div class="blog-main-right">
    <div class="blog-search">
        <form class="layui-form" action="<?=Helper::url('main','article')?>" method="get" id="formSearch">
            <div class="layui-form-item">
                <div class="search-keywords  shadow">
                    <input type="text" name="keyword" lay-verify="required" placeholder="输入关键词搜索" autocomplete="off" class="layui-input">
                </div>
                <div class="search-submit  shadow">
                    <button class="search-btn" lay-submit="formSearch" lay-filter="formSearch"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="article-category shadow">
        <div class="article-category-title">分类导航</div>
        <?php foreach ($cates as $cate) { ?>
            <a href=" <?= Helper::url('blog', 'article',
                ['cate_id' => $cate['id']]) ?>"><?= $cate['name'] ?></a>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="blog-module shadow">
        <div class="blog-module-title">热门文章</div>
        <ul class="fa-ul blog-module-ul">
            <?php foreach ($hosts as $host) { ?>
                <li style="line-height: 30px"><i class="fa-li fa fa-hand-o-right"></i><a
                            href="<?= Helper::url('blog', 'detail',
                                ['id' => $host['id']]) ?>"><?= $host['title'] ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <!--右边悬浮 平板或手机设备显示-->
    <div class="category-toggle"><i class="fa fa-chevron-left"></i></div>
</div>