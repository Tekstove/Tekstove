<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\EventDispatcher\EventDispacher;

/**
 * Description of LyricRepository
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricRepository
{
    private $eventDispacher;
    
    public function __construct(EventDispacher $eventDispacher)
    {
        $this->eventDispacher = $eventDispacher;
        
    }
    
    

    
    public function save(Lyric $lyric)
    {
        $lyric->setEventDispacher($this->eventDispacher);
        $lyric->save();
    }
}
