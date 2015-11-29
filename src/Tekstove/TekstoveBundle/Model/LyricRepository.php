<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\EventDispatcher\EventDispacher;
use Tekstove\CacheBundle\Model\Cache;

/**
 * Description of LyricRepository
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricRepository
{
    private $eventDispacher;
    private $cache;
    
    public function __construct(EventDispacher $eventDispacher, Cache $cache)
    {
        $this->eventDispacher = $eventDispacher;
        $this->cache = $cache;
    }
    
    

    
    public function save(Lyric $lyric)
    {
        $lyric->setEventDispacher($this->eventDispacher);
        $lyric->save();
    }
}
