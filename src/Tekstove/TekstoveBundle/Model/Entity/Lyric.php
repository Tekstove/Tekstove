<?php

namespace Tekstove\TekstoveBundle\Model\Entity;

use Tekstove\TekstoveBundle\Model\Entity\Base\Lyric as BaseLyric;

/**
 * Skeleton subclass for representing a row from the 'lyric' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Lyric extends BaseLyric
{
    public function preSave(\Propel\Runtime\Connection\ConnectionInterface $con = null) {
        
        $cacheTitleShort = $this->getTitle();
        $this->setcacheTitleShort($cacheTitleShort);
        return parent::preSave($con);
    }
}
