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

include_once(__DIR__. '/../Version2x8/ServerCommandsTest.php');

class ServerCommandsTest extends \Test\Integration\Version2x8\ServerCommandsTest {

    public function test_commandCount() {
        $Redis = static::$Redis;
        $this->assertSame(163, $Redis->commandCount());
    }

    /**
     * @see \RedisClient\Command\Traits\Version2x8\ServerCommandsTrait::commandGetkeys
     */
    public function _test_commandGetkeys() {
        $Redis = static::$Redis;
        $this->assertSame(['a', 'c', 'e'], $Redis->commandGetkeys('MSET a b c d e f'));
    }

    public function test_command() {
        $Redis = static::$Redis;

        $this->assertSame(true, is_array($commands = $Redis->command()));
        $skip = [
            'script', 'eval', 'echo',
            'latency', 'config', 'client',
            'pfdebug', 'pfselftest', 'replconf',
            'debug' ,'psync', 'cluster',
            'asking', 'restore-asking'
        ];
        foreach ($commands as $command) {
            if (in_array($command[0], $skip)) {
                continue;
            }
            $this->assertSame(true, method_exists($Redis, $command[0]) ?: $command);
        }
    }
}
