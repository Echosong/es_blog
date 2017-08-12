<?php

//命名一定不能合 m 命名相同否则路由  m 有限会算作模块

class MainController extends BaseController
{

    private function _data()
    {
        $keyword = Helper::request('keyword', '');
        //注意参数化拼接；
        if($this->routes['a'] == "resource"){
            $where = [" types = :types", ["types"=>0]];
        }else{
            $where = [" types = :types", ["types"=>1]];
        }
        if (!empty($keyword)) {
            $where[0] = $where[0]. ' and  title like :title';
            $where[1][':title'] = '%' . $keyword . '%';
        }
        if($this->routes['a'] == "home"){
            $where[0] = $where[0]. ' and is_top=1';
        }
        $postDb = new Post();
        $page = Helper::request('page', 1);
        $this->posts = $postDb->findAll($where, 'id desc', '*', [$page, 10]);

        $this->hosts = $postDb->findAll('', 'views desc', '*', 10);
        $cateDb = new Model('category');
        $this->cates = $cateDb->findAll();

        $this->pager = $this->pager($postDb->page, $where);
    }

    public function getHome()
    {
        $this->_data();
        $this->display("home.php");
    }

    public function getArticle()
    {
        $this->_data();
        $this->display("article.php");
    }

    public function getDetail()
    {
        $id = Helper::request('id', 0);
        if ($id == 0) {
            Helper::redirect("参数错误");
        }
        $postDb = new Post();
        $this->hosts = $postDb->findAll('', 'views desc', '*', 10);
        $cateDb = new Model('category');
        $this->cates = $cateDb->findAll();

        $postDb = new Post();
        $this->post = $postDb->find(['id' => $id]);
        $commentDb = new Model('comment');
        $this->comments = $commentDb->findAll(['post_id'=>$id], 'id desc');

        $this->display("detail.php");
    }

    public function getResource()
    {
        $this->_data();
        $this->display("resource.php");
    }

    public function getAbout()
    {
        $postDb = new Post();
        $this->post = $postDb->find(['id' => 1]);
        $this->display("about.php");
    }

    public function getTimeline()
    {
        $this->display("timeline.php");
    }

    public function postComment()
    {
        $v = App::validator($_POST);
        $v->mapFieldsRules(Comment::$rules);
        if(!$v->validate()) {
            Helper::responseJson($v->errors(),3);
        }
        $commentDb = new Comment();
        $commentDb->create(
            [
                'username'=>$_POST['username'],
                'content'=>$_POST['content'],
                'post_id'=>$_POST['post_id'],
                'created'=>date('Y-m-d H:i:s')
            ]
        );
        Helper::responseJson("成功");
    }
}