<?php

namespace Tekstove\TekstoveBundle\EventListener\Model\Lyric;

use Tekstove\TekstoveBundle\Model\Lyric;
use Tekstove\TekstoveBundle\EventDispatcher\Event;

/**
 * Description of LyricSubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricTitleCacheSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            'tekstove.lyric.save' => 'saveEvent',
        );
    }
    
    public function saveEvent(Event $event)
    {
        $lyric = $event->getSubject();
        $this->updateCache($lyric);
    
    }

    public function updateCache(Lyric $lyric)
    {
        $cacheTitleShort = '';
        $cacheTitleShort .= $lyric->getTitle();
        $lyric->setcacheTitleShort($cacheTitleShort);
    }
}
