<?php

namespace Tekstove\TekstoveBundle\EventListener\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Tekstove\TekstoveBundle\Entity\Lyric;
use Tekstove\TekstoveBundle\Entity\User;

/**
 * Description of LyricSubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
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
        $lyric->setCacheTitleShort($cacheTitleShort);
    }
}
