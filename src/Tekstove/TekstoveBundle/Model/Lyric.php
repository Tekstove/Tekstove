<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\Model\Lyric\Exception\ValidationException;
use Tekstove\TekstoveBundle\Model\Base\Lyric as BaseLyric;
use Propel\Runtime\Connection\ConnectionInterface;

class Lyric extends BaseLyric
{
    public function preSave(ConnectionInterface $con = null)
    {
        if (!$this->validate()) {
            throw new ValidationException('validation failed');
        }
        return parent::preSave($con);
    }
    
    public function getCacheVotes()
    {
        // @TODO @FIXME
        return '@TODO';
    }
}
