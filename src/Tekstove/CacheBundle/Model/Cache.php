<?php

namespace Tekstove\CacheBundle\Model;

use Tekstove\CacheBundle\Model\Cache\Adapter\AdapterInterface;

/**
 * Description of Cache
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Cache
{
    /**
     * @var AdapterInterface
     */
    private $adapter;
    
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     *
     * @param type $key
     * @param type $value
     * @param type $time
     * @return type
     */
    public function set($key, $value, $time = null)
    {
        $this->adapter->set($key, $value, $time);
    }

    /**
     *
     * @param type $key
     * @return type
     */
    public function get($key)
    {
        return $this->adapter->get($key);
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        $this->adapter->delete($key);
    }
}
