<?php
use Valitron\Validator;
use RedisClient\RedisClient;

class App
{
    private static $_validator;
    /**
     * 获取校验代码
     * @param array $post
     * @return Validator
     */
    public static function validator($post)
    {
        if (empty(self::$_validator)) {
            self::$_validator = new Validator($post, null, 'zh-cn');
        }
        return self::$_validator;
    }

    /**
     * 缓存实现
     */
    public static function redis()
    {
        if (empty(self::$_redis)) {
            self::$_redis = new RedisClient($GLOBALS['redis']);
        }
        return self::$_redis;
    }


}