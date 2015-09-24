<?php

namespace Tekstove\TekstoveBundle\EventListener\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Tekstove\TekstoveBundle\Entity\Lyric;

/**
 * Description of LyricSubscriber
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricSubscriber implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Lyric) {
            $this->updateCache($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Lyric) {
            $this->updateCache($entity);
        }
    }

    public function updateCache(Lyric $lyric)
    {
        $cacheTitleShort = '';
        $cacheTitleShort .= $lyric->getTitle();
        $lyric->setCacheTitleShort($cacheTitleShort);
    }
}
