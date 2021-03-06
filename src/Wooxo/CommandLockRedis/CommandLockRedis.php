<?php
namespace Wooxo\CommandLockRedis;
use Illuminate\Support\Facades\Redis;
/**
 * Library CommandLockRedis
 *
 * @package Wooxo\CommandLockRedis
 */
class CommandLockRedis {

    private static $redis;

    /**
     * Create a lock
     * @param string $name
     * @param integer $expirationTime
     *
     * @return bool
     */
    public static function createLock($name, $expirationTime = 3600) {
        $expirationTime = intval($expirationTime);
        if(!self::checkLock($name)) {
            $key =Redis::connection()->set('lock_'.$name, 'LOCK');
            Redis::connection()->expire('lock_'.$name, $expirationTime);
            return $key;
        } else {
            return false;
        }
    }

    /**
     *
     * Check the existence of a lock
     * @param string $name
     *
     * @return bool
     */
    public static function checkLock($name) {
        if(Redis::connection()->get('lock_'.$name)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete an existant lock
     * @param string $name
     *
     * @return bool
     */
    public static function deleteLock($name) {
        if(self::checkLock($name)) {
            return Redis::connection()->del('lock_'.$name);
        } else {
            return false;
        }
    }
}
