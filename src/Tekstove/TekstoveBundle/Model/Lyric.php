<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\Model\Lyric\Exception\ValidationException;
use Tekstove\TekstoveBundle\Model\Base\Lyric as BaseLyric;
use Propel\Runtime\Connection\ConnectionInterface;

use Tekstove\TekstoveBundle\EventDispatcher\Event;

class Lyric extends BaseLyric
{
    private $eventDispacher;
    
    public function preSave(ConnectionInterface $con = null)
    {
        if (!$this->validate()) {
            throw new ValidationException('validation failed');
        }
        
        $this->notifyPreSave($this);
        
        return parent::preSave($con);
    }
    
    /**
     *
     * @return EventDispatcher\EventDispacher
     */
    private function getEventDispacher()
    {
        if ($this->eventDispacher === null) {
            throw new \Exception('eventDispacher not set');
        }
        return $this->eventDispacher;
    }
    
    function setEventDispacher($eventDispacher)
    {
        $this->eventDispacher = $eventDispacher;
    }

    private function notifyPreSave(Lyric $lyric)
    {
        $event = new Event($lyric);
        $this->getEventDispacher()->dispatch('tekstove.lyric.save', $event);
    }
}
