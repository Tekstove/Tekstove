<?php

namespace Tekstove\SiteBundle\EventDispatcher;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Tekstove\SiteBundle\EventListener\Model\Lyric\LyricTitleCacheSubscriber;
use Tekstove\SiteBundle\EventListener\Model\Lyric\LyricUploadedBySubscriber;

/**
 * Description of EventDispacherFactory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class EventDispacherFactory
{
    public static function createDispacher(ContainerInterface $container)
    {
        $dispacher = new EventDispacher();
        // add events!
        $titleCacheSubscriber = new LyricTitleCacheSubscriber();

        $securityTokenStorage = $container->get('security.token_storage');
        $authzChecker = $container->get('security.authorization_checker');
        
        $uploadedBySubscriber = new LyricUploadedBySubscriber(
            $securityTokenStorage,
            $authzChecker
        );
       
        $dispacher->addSubscriber($titleCacheSubscriber);
        $dispacher->addSubscriber($uploadedBySubscriber);
        return $dispacher;
    }
}
