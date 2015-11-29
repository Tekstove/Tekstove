<?php

namespace Tekstove\CacheBundle\Model\Cache\Adapter;

/**
 * Description of Memcached
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Memcached implements AdapterInterface
{
    private $adapter;
    
    public function __construct(array $servers)
    {
        $this->adapter = new \Memcached();
        foreach ($servers as $server) {
            $this->adapter->addServer($server['host'], $server['port'], $server['weight']);
        }
    }
    
    public function set($key, $value, $time = null)
    {
        $this->adapter->set($key, $value, $time);
    }

    public static function delete($key)
    {
        $this->adapter->delete($key);
    }

    public static function get($key)
    {
        $this->adapter->get($key);
    }
}