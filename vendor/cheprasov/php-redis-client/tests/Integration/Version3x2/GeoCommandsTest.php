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
namespace Test\Integration\Version3x2;

include_once(__DIR__ . '/../BaseVersionTest.php');

use RedisClient\Exception\ErrorResponseException;

/**
 * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait
 */
class GeoCommandsTest extends \Test\Integration\BaseVersionTest {

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::geoadd
     */
    public function test_geoadd() {
        $Redis = static::$Redis;

        $this->assertSame(2, $Redis->geoadd('Sicily', [
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame('166274.1516', $Redis->geodist('Sicily', 'Palermo', 'Catania'));
        $this->assertSame(['Catania'], $Redis->georadius('Sicily', 15, 37, 100, 'km'));
        $this->assertSame(['Palermo', 'Catania'], $Redis->georadius('Sicily', 15, 37, 200, 'km'));

        $this->assertSame(0, $Redis->geoadd('Sicily', ['Palermo' => ['13.361389', '38.115556']]));

        $this->assertSame(1, $Redis->geoadd('bar', ['Palermo' => ['13.361389', '38.115556']]));
        $this->assertSame(0, $Redis->geoadd('bar', ['Palermo' => ['13.361389', '38.115556']]));
        $this->assertSame(1, $Redis->geoadd('bar', ['Catania' => ['15.087269', '37.502669']]));

        $Redis->set('foo', 'bar');
        try {
            $Redis->geoadd('foo', ['Palermo' => ['13.361389', '38.115556']]);
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::geodist
     */
    public function test_geodist() {
        $Redis = static::$Redis;

        $this->assertSame(2, $Redis->geoadd('Sicily', [
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame('166274.1516', $Redis->geodist('Sicily', 'Palermo', 'Catania'));
        $this->assertSame('166274.1516', $Redis->geodist('Sicily', 'Palermo', 'Catania', 'm'));
        $this->assertSame('166.2742', $Redis->geodist('Sicily', 'Palermo', 'Catania', 'km'));
        $this->assertSame('103.3182', $Redis->geodist('Sicily', 'Palermo', 'Catania', 'mi'));
        $this->assertSame('545518.8700', $Redis->geodist('Sicily', 'Palermo', 'Catania', 'ft'));

        $this->assertSame('166274.1516', $Redis->geodist('Sicily', 'Catania', 'Palermo'));
        $this->assertSame('166274.1516', $Redis->geodist('Sicily', 'Catania', 'Palermo', 'm'));
        $this->assertSame('166.2742', $Redis->geodist('Sicily', 'Catania', 'Palermo', 'km'));
        $this->assertSame('103.3182', $Redis->geodist('Sicily', 'Catania', 'Palermo', 'mi'));
        $this->assertSame('545518.8700', $Redis->geodist('Sicily', 'Catania', 'Palermo', 'ft'));

        $this->assertSame('0.0000', $Redis->geodist('Sicily', 'Catania', 'Catania'));
        $this->assertSame('0.0000', $Redis->geodist('Sicily', 'Catania', 'Catania', 'm'));
        $this->assertSame('0.0000', $Redis->geodist('Sicily', 'Catania', 'Catania', 'km'));
        $this->assertSame('0.0000', $Redis->geodist('Sicily', 'Catania', 'Catania', 'mi'));
        $this->assertSame('0.0000', $Redis->geodist('Sicily', 'Catania', 'Catania', 'ft'));

        $this->assertSame(null, $Redis->geodist('Sicily', 'Catania', 'foo', 'ft'));
        $this->assertSame(null, $Redis->geodist('Sicily', 'bar', 'foo'));

        $Redis->set('foo', 'bar');
        try {
            $Redis->geodist('foo', 'Catania', 'Palermo');
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::geohash
     */
    public function test_geohash() {
        $Redis = static::$Redis;

        $this->assertSame(2, $Redis->geoadd('Sicily', [
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame(['sqc8b49rny0'], $Redis->geohash('Sicily', ['Palermo']));
        $this->assertSame(['sqc8b49rny0', 'sqdtr74hyu0'], $Redis->geohash('Sicily', ['Palermo', 'Catania']));
        $this->assertSame(['sqdtr74hyu0'], $Redis->geohash('Sicily', ['Catania']));
        $this->assertSame([null], $Redis->geohash('Sicily', ['foo']));
        $this->assertSame([null, 'sqc8b49rny0'], $Redis->geohash('Sicily', ['foo', 'Palermo']));
        $this->assertSame([null, 'sqc8b49rny0', null], $Redis->geohash('Sicily', ['foo', 'Palermo', 'bar']));
        $this->assertSame(['sqc8b49rny0', 'sqc8b49rny0'], $Redis->geohash('Sicily', ['Palermo', 'Palermo']));

        $this->assertSame([], $Redis->geohash('foo', ['a']));
        $this->assertSame([], $Redis->geohash('foo', ['a', 'b', 'c']));

        $this->assertSame(null, $Redis->geodist('Sicily', 'Catania', 'foo', 'ft'));
        $this->assertSame(null, $Redis->geodist('Sicily', 'bar', 'foo'));

        $Redis->set('foo', 'bar');
        try {
            $Redis->geodist('foo', 'bar', 'foo');
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::geopos
     */
    public function test_geopos() {
        $Redis = static::$Redis;

        $this->assertSame(2, $Redis->geoadd('Sicily', [
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame([
            ['13.36138933897018433', '38.11555639549629859'],
            ['15.08726745843887329', '37.50266842333162032'],
            null
        ], $Redis->geopos('Sicily', ['Palermo', 'Catania', 'NonExisting']));

        $this->assertSame([
            ['13.36138933897018433', '38.11555639549629859'],
            ['13.36138933897018433', '38.11555639549629859'],
        ], $Redis->geopos('Sicily', ['Palermo', 'Palermo']));

        $Redis->set('foo', 'bar');
        try {
            $Redis->geopos('foo', ['bar', 'foo']);
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::georadius
     */
    public function test_georadius() {
        $Redis = static::$Redis;

        $this->assertSame(2, $Redis->geoadd('Sicily', [
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame(['Catania'], $Redis->georadius('Sicily', 15, 37, 100, 'km'));
        $this->assertSame(['Palermo', 'Catania'], $Redis->georadius('Sicily', 15, 37, 200, 'km'));
        $this->assertSame(['Catania', 'Palermo'], $Redis->georadius('Sicily', 15, 37, 200, 'km', false, false, false, null, true));
        $this->assertSame(['Palermo', 'Catania'], $Redis->georadius('Sicily', 15, 37, 200, 'km', false, false, false, null, false));
        $this->assertSame(['Palermo'], $Redis->georadius('Sicily', 15, 37, 200, 'km', false, false, false, 1, false));
        $this->assertSame(['Catania'], $Redis->georadius('Sicily', 15, 37, 200, 'km', false, false, false, 1, true));

        $this->assertSame(1, $Redis->georadius('Sicily', 15, 37, 100, 'km', false, false, false, null, null, 'my-list'));
        $this->assertSame(['Catania'], $Redis->zrange('my-list', 0, -1));
        $this->assertSame(['Catania' => '3479447370796909'], $Redis->zrange('my-list', 0, -1, true));
        $this->assertSame(1, $Redis->georadius('Sicily', 15, 37, 100, 'km', false, false, false, null, null, 'my-list', true));
        $this->assertSame(['Catania' => '56.441257870158204'], $Redis->zrange('my-list', 0, -1, true));

        $this->assertSame(2, $Redis->georadius('Sicily', 15, 37, 200, 'km', false, false, false, null, null, 'my-list'));
        $this->assertSame(['Palermo', 'Catania'], $Redis->zrange('my-list', 0, -1));

        $this->assertSame([
                'Palermo' => ['190.4424'],
                'Catania' => ['56.4413']
            ], $Redis->georadius('Sicily', 15, 37, 200, 'km', false, true)
        );
        $this->assertSame([
            'Catania' => ['56.4413', 3479447370796909, ['15.08726745843887329', '37.50266842333162032']]
            ], $Redis->georadius('Sicily', 15, 37, 100, 'km', true, true, true)
        );
        $this->assertSame([
            'Catania' => ['56.4413', 3479447370796909, ['15.08726745843887329', '37.50266842333162032']]
            ], $Redis->georadius('Sicily', 15, 37, 100, 'km', true, true, true)
        );
        $this->assertSame([
            'Palermo' => ['190.4424', 3479099956230698, ['13.36138933897018433', '38.11555639549629859']],
            'Catania' => ['56.4413', 3479447370796909, ['15.08726745843887329', '37.50266842333162032']]
            ], $Redis->georadius('Sicily', 15, 37, 200, 'km', true, true, true)
        );
        $this->assertSame([
            'Palermo' => ['190.4424', 3479099956230698, ['13.36138933897018433', '38.11555639549629859']],
            'Catania' => ['56.4413', 3479447370796909, ['15.08726745843887329', '37.50266842333162032']]
            ], $Redis->georadius('Sicily', 15, 37, 200, 'km', true, true, true, null, false)
        );
        $this->assertSame([
            'Catania' => [['15.08726745843887329', '37.50266842333162032']]
            ], $Redis->georadius('Sicily', 15, 37, 100, 'km', true)
        );

        $Redis->set('foo', 'bar');
        try {
            $Redis->georadius('foo', 15, 37, 100, 'km');
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::georadiusbymember
     */
    public function test_georadiusbymember() {
        $Redis = static::$Redis;

        $this->assertSame(3, $Redis->geoadd('Sicily', [
            'Agrigento' => ['13.583333', '37.316667'],
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame(2, $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km', false, false, false, null, null, 'my-list'));
        $this->assertSame(['Agrigento', 'Palermo'], $Redis->zrange('my-list', 0, -1));
        $this->assertSame([
            'Agrigento' => '3479030013248308',
            'Palermo' => '3479099956230698',
        ], $Redis->zrange('my-list', 0, -1, true));

        $this->assertSame(2, $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km', false, false, false, null, null, 'my-list', true));
        $this->assertSame(['Agrigento', 'Palermo'], $Redis->zrange('my-list', 0, -1));
        $this->assertSame([
            'Agrigento' => '0',
            'Palermo' => '90.977753537996037',
        ], $Redis->zrange('my-list', 0, -1, true));

        $this->assertSame(['Agrigento', 'Palermo'], $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km'));
        $this->assertSame(['Agrigento'], $Redis->georadiusbymember('Sicily', 'Agrigento', 0, 'km'));
        $this->assertSame(['Agrigento', 'Palermo'], $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km', null, null, null, null, true));
        $this->assertSame(['Palermo', 'Agrigento'], $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km', null, null, null, null, false));

        $this->assertSame([
            'Palermo' => ['90.9778', 3479099956230698, ['13.36138933897018433', '38.11555639549629859']],
            'Agrigento' => ['0.0000', 3479030013248308, ['13.5833314061164856', '37.31666804993816555']],
            ], $Redis->georadiusbymember('Sicily', 'Agrigento', 100, 'km', true, true, true, null, false)
        );

        $Redis->set('foo', 'bar');
        try {
            $Redis->georadiusbymember('foo', 'Agrigento', 100, 'km');
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

    /**
     * @see \RedisClient\Command\Traits\Version3x2\GeoCommandsTrait::geodel
     */
    public function test_geodel() {
        $Redis = static::$Redis;

        $this->assertSame(3, $Redis->geoadd('Sicily', [
            'Agrigento' => ['13.583333', '37.316667'],
            'Palermo' => ['13.361389', '38.115556'],
            'Catania' => ['15.087269', '37.502669']
        ]));

        $this->assertSame(['Agrigento', 'Palermo', 'Catania'], $Redis->georadiusbymember('Sicily', 'Agrigento', 300, 'km', 0, 0, 0, 0, true));

        $this->assertSame(1, $Redis->geodel('Sicily', 'Palermo'));
        $this->assertSame(['Agrigento', 'Catania'], $Redis->georadiusbymember('Sicily', 'Agrigento', 300, 'km', 0, 0, 0, 0, true));

        $this->assertSame(0, $Redis->geodel('Sicily', 'Palermo'));
        $this->assertSame(['Agrigento', 'Catania'], $Redis->georadiusbymember('Sicily', 'Agrigento', 300, 'km', 0, 0, 0, 0, true));

        $this->assertSame(1, $Redis->geodel('Sicily', ['Catania', 'Catania', 'Palermo']));
        $this->assertSame(['Agrigento'], $Redis->georadiusbymember('Sicily', 'Agrigento', 300, 'km', 0, 0, 0, 0, true));

        $Redis->set('foo', 'bar');
        try {
            $Redis->geodel('foo', 'Agrigento');
            $this->assertFalse('Expect Exception');
        } catch (\Exception $Ex) {
            $this->assertInstanceOf(ErrorResponseException::class, $Ex);
        }
    }

}
