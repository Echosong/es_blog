<?php
/**
 * This file is part of RedisClient.
 * git: https://github.com/cheprasov/php-redis-client
 *
 * (C) Alexander Cheprasov <cheprasov.84@ya.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Test\Integration\Version3x0;

include_once(__DIR__. '/../Version2x8/SortedSetsCommandsTest.php');

use RedisClient\Exception\ErrorResponseException;

/**
 * @see \RedisClient\Command\Traits\Version3x0\SortedSetsCommandsTrait
 */
class SortedSetsCommandsTest extends \Test\Integration\Version2x8\SortedSetsCommandsTest {

    /**
     * @see \RedisClient\Command\Traits\Version3x0\SortedSetsCommandsTrait::zadd
     */
    public function test_zadd() {
        $Redis = static::$Redis;

        $this->assertSame(3, $Redis->zadd('zset', ['a' => 0, 'b' => 2, 'c' => 3]));
        $list = $Redis->zrange('zset', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '0', 'b' => '2', 'c' => '3'], $list);

        $this->assertSame(0, $Redis->zadd('zset', ['a' => 0, 'b' => 2, 'c' => 3]));

        $this->assertSame(0, $Redis->zadd('zset', ['a' => 1, 'b' => 2, 'c' => 3]));
        $list = $Redis->zrange('zset', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '1', 'b' => '2', 'c' => '3'], $list);

        $this->assertSame(2, $Redis->zadd('bar', ['-inf' => '-inf', '+inf' => '+inf']));
        $list = $Redis->zrange('bar', 0, -1, true); ksort($list);
        $this->assertSame(['+inf' => 'inf', '-inf' => '-inf'], $list);

        $this->assertSame(0, $Redis->zadd('zset', ['b' => 4, 'd' => 5], 'XX'));
        $list = $Redis->zrange('zset', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '1', 'b' => '4', 'c' => '3'], $list);

        $this->assertSame(1, $Redis->zadd('zset', ['b' => 5, 'e' => 5], 'NX'));
        $list = $Redis->zrange('zset', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '1', 'b' => '4', 'c' => '3', 'e' => '5'], $list);

        $this->assertSame(3, $Redis->zadd('zset', ['a' => 11, 'b' => 11, 'f' => 75], null, true));
        $list = $Redis->zrange('zset', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '11', 'b' => '11', 'c' => '3', 'e' => '5', 'f' => '75'], $list);

        $this->assertSame(3, $Redis->zadd('foo', ['a' => 1, 'b' => 2, 'c' => 3]));

        $this->assertSame('2', $Redis->zadd('foo', ['a' => 1], null, null, true));
        $list = $Redis->zrange('foo', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '2', 'b' => '2', 'c' => '3'], $list);

        $this->assertSame('10', $Redis->zadd('foo', ['e' => 10], null, null, true));
        $list = $Redis->zrange('foo', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '2', 'b' => '2', 'c' => '3', 'e' => '10'], $list);

        $this->assertSame('-10', $Redis->zadd('foo', ['e' => -20], null, null, true));
        $list = $Redis->zrange('foo', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '2', 'b' => '2', 'c' => '3', 'e' => '-10'], $list);

        $this->assertSame(null, $Redis->zadd('foo', ['e' => -10], 'NX', null, true));
        $list = $Redis->zrange('foo', 0, -1, true); ksort($list);
        $this->assertSame(['a' => '2', 'b' => '2', 'c' => '3', 'e' => '-10'], $list);

        $Redis->set('string', 'value');
        try {
            $Redis->zadd('string', ['a' => 0, 'b' => 2, 'c' => 3]);
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

}
