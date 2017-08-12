<link href="/res/css/article.css" rel="stylesheet" />
<!-- 主体（一般只改变这里的内容） -->
<div class="blog-body">
    <div class="blog-container">
        <blockquote class="layui-elem-quote sitemap layui-breadcrumb shadow">
            <a href="home.html" title="网站首页">网站首页</a>
            <a href="article.html" title="文章专栏">文章专栏</a>
            <a><cite><?=$post["title"]?></cite></a>
        </blockquote>
        <div class="blog-main">
            <div class="blog-main-left">
                <!-- 文章内容（使用Kingeditor富文本编辑器发表的） -->
                <div class="article-detail shadow">
                    <div class="article-detail-title">
                        <?=$post["title"]?>

                    </div>
                    <div class="article-detail-info">
                        <span>编辑时间：<?=$post['updated']?> </span>
                        <span>作者：Echosong</span>
                        <span>浏览量：<?=$post['views']?> </span>
                    </div>
                    <div class="article-detail-content">
                      <?=$post['content']?>
                    </div>
                </div>
                <!-- 评论区域 -->
                <div class="blog-module shadow" style="box-shadow: 0 1px 8px #a6a6a6;">
                    <fieldset class="layui-elem-field layui-field-title" style="margin-bottom:0">
                        <legend>来说两句吧</legend>
                        <div class="layui-field-box">
                            <form class="layui-form blog-editor" action="<?=Helper::url('main', 'comment')?>" method="post">
                                <div class="layui-form-item">

                                    <input type="hidden" name="post_id" value="<?=$post['id']?>">
                                    <input type="text" name="username"  lay-verify="required" placeholder="请输你的昵称" autocomplete="off" class="layui-input">
                                </div>

                                <div class="layui-form-item">

                                    <textarea name="content" lay-verify="content" id="content"
                                              placeholder="请输入内容" class="layui-textarea layui-hide"></textarea>
                                </div>

                                <div class="layui-form-item">
                                    <button class="layui-btn"   lay-submit="formRemark" lay-filter="formRemark">提交评论
                                    </button>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                    <div class="blog-module-title">最新评论</div>
                    <ul class="blog-comment">
                        <?php foreach ($comments as $item) {?>

                        <li>
                            <div class="comment-parent">
                                <div class="info">
                                    <span class="username"><?=strip_tags($item['username'])?></span>
                                    <span class="time"><?=strip_tags($item['created'])?> </span>
                                </div>
                                <div class="content">
                                    <?=$item['content']?>

                                </div>
                            </div>
                        </li>
                       <?php } ?>
                    </ul>
                </div>
            </div>
            <?php include "right.php" ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<script>
    layui.use(['form', 'layedit'], function(){
        var layedit = layui.layedit;
        var index = layedit.build('content'); //建立编辑器
        var form = layui.form();
        //监听提交
        form.on('submit(formRemark)', function(data){
           data.field.content  = layedit.getContent(index);
            $.post('<?=Helper::url('main','comment')?>', data.field, function (msg) {
                if(msg.code == 0){
                    layer.msg(msg.message);
                    location.reload();
                }else{
                    layer.msg(JSON.stringify(msg.message));
                }
            },'json');
            return false;
        });
    });

</script>
