<?php

namespace Tekstove\CacheBundle\Model;

/**
 * Description of Cache
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Cache {
    
    private $adapter;
    
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }
    
    
}
