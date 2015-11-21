<?php

namespace Tekstove\TekstoveBundle\Model\EventDispatcher;

/**
 * Description of EventDispacherFactory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class EventDispacherFactory {
    public static function createDispacher()
    {
        $dispacher = new EventDispacher();
        // add events!
        $testEvent = new \Tekstove\TekstoveBundle\EventListener\Entity\LyricSubscriber();
        $dispacher->addSubscriber($testEvent);
        return $dispacher;
    }
}
