<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\Model\Lyric\Exception\ValidationException;
use Tekstove\TekstoveBundle\Model\Base\Lyric as BaseLyric;
use Propel\Runtime\Connection\ConnectionInterface;

class Lyric extends BaseLyric
{
    private $eventManager;
    
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
        if ($this->eventManager === null) {
            throw new \Exception('eventDispacher not set');
        }
        return $this->eventManager;
    }
    
    function setEventDispacher($eventManager) {
        $this->eventManager = $eventManager;
    }

    private function notifyPreSave(Lyric $lyric)
    {
        $event = new EventDispatcher\Event($lyric);
        $this->getEventDispacher()->dispatch('tekstove.lyric.save', $event);
    }
    
}
