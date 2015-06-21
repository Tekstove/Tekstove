<?php

namespace Tekstove\TekstoveBundle\Model\Entity;

use Tekstove\TekstoveBundle\Model\Entity\Base\Albums as BaseAlbums;

/**
 * Skeleton subclass for representing a row from the 'albums' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Albums extends BaseAlbums
{
    public function getArtist1()
    {
        if (empty($this->artist1id)) {
            return null;
        }
        
        $artistManager = new ArtistsQuery();
        $artist = $artistManager->findById($this->artist1id);
        
        return $artist;
    }
}
