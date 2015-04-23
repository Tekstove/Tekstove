<?php

namespace Tekstove\TekstoveBundle\Model\Lyric\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of ChangeText
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ChangeText extends Event
{

    private $lyric;

    public function __construct(\Tekstove\TekstoveBundle\Model\Lyric $lyric) {
        $this->lyric = $lyric;
    }

    public function getLyric() {
        return $this->lyric;
    }

}
