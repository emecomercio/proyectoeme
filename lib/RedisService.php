<?php

namespace Lib;

use Predis\Client;

/**
 * 
 *
 * @property Client|null $redis
 */
class RedisService
{
    private static $redis = null;

    public static function getClient()
    {
        if (self::$redis === null) {
            self::$redis = new Client([
                'scheme' => 'tcp',
                'host'   => $_ENV["REDIS_HOST"],
                'port'   => $_ENV["REDIS_PORT"],
            ]);
        }

        return self::$redis;
    }
}
