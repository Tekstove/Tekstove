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
    public function getArtist1() {
        $id = parent::getArtist1();
        $artistRepo = ArtistQuery::create();
        $artist = $artistRepo->findOneById($id);
        return $artist;
    }
    
    public function getuploader() {
        $id = parent::getuploader();
        $usersRepo = UsersQuery::create();
        $user = $usersRepo->findOneById($id);
        return $user;
    }
    
}
