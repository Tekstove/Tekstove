<?php

namespace Tekstove\TekstoveBundle\Model\Lyric\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of RetrieveEvent
 *
 * @author potaka
 */
class Retrieve extends Event
{

    private $lyric;

    public function __construct(\Tekstove\TekstoveBundle\Model\Lyric $lyric) {
        $this->lyric = $lyric;
    }

    public function getLyric() {
        return $this->lyric;
    }

}
