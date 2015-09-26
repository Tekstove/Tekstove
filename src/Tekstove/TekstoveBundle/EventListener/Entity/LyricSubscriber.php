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
class LyricSubscriber implements EventSubscriber
{

    private $tokenStorage;
    
    public function __construct(TokenStorage $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * 
     * @return User|string
     */
    private function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    
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
        
        $user = $this->getUser();
        if ($user instanceof User) {
            $entity->setUploadedBy($user);
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
