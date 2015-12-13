<?php

namespace Tekstove\CacheBundle\Model\Cache\Adapter;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface AdapterInterface
{

    /**
     * 
     * @param type $key
     * @param type $value
     * @param type $time
     * @return type
     */
    public function set($key, $value, $time = null);

    /**
     * 
     * @param type $key
     * @return type
     */
    public function get($key);

    /**
     * @param string $key
     */
    public function delete($key);
}
