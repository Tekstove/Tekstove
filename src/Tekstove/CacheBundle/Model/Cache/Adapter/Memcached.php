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
            $result = $this->adapter->addServer($server['host'], $server['port'], $server['weight']);
            if (!$result) {
                throw new \Exception("Can't add memcached server");
            }
        }
    }
    
    public function set($key, $value, $time = null)
    {
        $result = $this->adapter->set($key, $value, time() + $time);
        if (!$result) {
                throw new \Exception("Can't save cache");
            }
    }

    public function delete($key)
    {
        $this->adapter->delete($key);
    }

    public function get($key)
    {
        return $this->adapter->get($key);
    }
}
