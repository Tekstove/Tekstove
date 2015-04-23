<?php

namespace Tekstove\TekstoveBundle\Model\Lyric\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Description of Retrieve
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Retrieve implements EventSubscriberInterface
{

    public static function getSubscribedEvents() {
        return [
            \Tekstove\TekstoveBundle\Model\Lyric\Events::RETRIEVE => [
                [
                    'onRetrieve', 0,
                ],
            ],
        ];
    }

    public function onRetrieve(\Tekstove\TekstoveBundle\Model\Lyric\Event\Retrieve $event) {
        // maybe check ACL
    }

}
