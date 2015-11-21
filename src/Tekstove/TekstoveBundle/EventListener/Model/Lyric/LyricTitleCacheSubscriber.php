<?php

namespace Tekstove\TekstoveBundle\EventListener\Model\Lyric;

use Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of LyricSubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricTitleCacheSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{

    public function __construct() {
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            'tekstove.lyric.save' => 'saveEvent',
        );
    }
    
    public function saveEvent()
    {
        throw new \Exception('test events');
    }

    public function updateCache(Lyric $lyric)
    {
        $cacheTitleShort = '';
        $cacheTitleShort .= $lyric->getTitle();
        $lyric->setcacheTitleShort($cacheTitleShort);
    }
}
