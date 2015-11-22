<?php

namespace Tekstove\TekstoveBundle\Model\EventDispatcher;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of EventDispacherFactory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class EventDispacherFactory {
    public static function createDispacher(ContainerInterface $container)
    {
        $dispacher = new EventDispacher();
        // add events!
        $titleCacheSubscriber = new \Tekstove\TekstoveBundle\EventListener\Model\Lyric\LyricTitleCacheSubscriber();
        
        $securityTokenStorage = $container->get('security.token_storage');
        $authzChecker = $container->get('security.authorization_checker');
        
        $uploadedBySubscriber = new \Tekstove\TekstoveBundle\EventListener\Model\Lyric\LyricUploadedBySubscriber(
            $securityTokenStorage,
            $authzChecker
        );
       
        $dispacher->addSubscriber($titleCacheSubscriber);
        $dispacher->addSubscriber($uploadedBySubscriber);
        return $dispacher;
    }
}
