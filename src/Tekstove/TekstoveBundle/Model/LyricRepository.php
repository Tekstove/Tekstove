<?php

namespace Tekstove\TekstoveBundle\Model;

use Propel\Runtime\ActiveQuery\Criteria;

use Tekstove\TekstoveBundle\Model\LyricQuery;

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
    /**
     * @var Cache
     */
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
    
    public function getCachedTopNew()
    {
        $cache = $this->cache->get('tekstove.lyric.topNew');
        if ($cache) {
            return $cache;
        }
        
        $newestQuery = new LyricQuery();
        /* @var $newestQuery \Tekstove\TekstoveBundle\Model\LyricQuery */
        $newestQuery->orderById(Criteria::DESC);
        $newestQuery->limit(10);
        $lastLyricsCollection = $newestQuery->find();
        $lastLyrics = $lastLyricsCollection->getArrayCopy();
        $this->cache->set('tekstove.lyric.topNew', $lastLyrics, 60*15);
        return $lastLyrics;
    }
}
