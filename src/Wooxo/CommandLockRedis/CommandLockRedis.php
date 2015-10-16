<?php
namespace Wooxo\CommandLockRedis;
use Illuminate\Support\Facades\Redis;
/**
 * Library CommandLockRedis
 *
 * @package Wooxo\CommandLockRedis
 */
class CommandLockRedis {

    private $redis;

    public function __construct() {
        $this->redis = Redis::connection();
    }

    /**
     * Create a lock
     * @param string $name
     * @param integer $expirationTime
     *
     * @return bool
     */
    public function createLock(string $name, $expirationTime = 3600) {
        $expirationTime = intval($expirationTime);
        if(!$this->checkLock($name)) {
            return $this->redis->set($name, 'LOCK', $expirationTime);
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
    public function checkLock(string $name) {
        if($this->redis->get($name)) {
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
    public function deleteLock(string $name) {
        if($this->checkLock($name)) {
            return $this->redis->delete($name);
        } else {
            return false;
        }
    }
}
