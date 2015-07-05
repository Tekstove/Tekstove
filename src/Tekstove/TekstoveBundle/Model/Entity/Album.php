<?php

namespace Tekstove\TekstoveBundle\Model\Entity;

use Tekstove\TekstoveBundle\Model\Entity\Base\Album as BaseAlbum;

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
class Album extends BaseAlbum
{
    public function getArtist1()
    {
        if (empty($this->artist1id)) {
            return null;
        }
        
        $artistManager = new ArtistQuery();
        $artist = $artistManager->findOneById($this->artist1id);
        
        return $artist;
    }
}
