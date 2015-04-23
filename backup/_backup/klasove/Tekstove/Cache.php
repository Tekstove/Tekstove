<?php

namespace Tekstove;

/**
 * Description of Cache
 *
 * @author potaka
 */
class Cache
{

    protected static $instance = null;

    /**
     * 
     * @return \Memcached
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new \Memcached();
            static::$instance->addServer('localhost', 11211);
        }

        return static::$instance;
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * @param type $time
     * @return type
     */
    public static function set($key, $value, $time = null)
    {
        return static::getInstance()->set($key, $value, $time);
    }

    /**
     * 
     * @param type $key
     * @return type
     */
    public static function get($key)
    {
        return static::getInstance()->get($key);
    }

    /**
     * @param string $key
     */
    public static function delete($key) 
    {
        static::getInstance()
                    ->delete($key);
    }
}
