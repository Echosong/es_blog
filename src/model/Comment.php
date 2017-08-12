<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/12
 * Time: 19:46
 */
class Comment extends Model
{
    public $table_name = "tb_comment";

    //验证字段规则
    public static $rules = [
        'post_id' => ['required', 'integer'],
        'username' => ['required', ['lengthMin', 3]],
        'content' => ['required', ['lengthMin', 6]]
    ];

}