<?php

namespace Test\Model\Artist;

use PHPUnit\Framework\TestCase;

use Tekstove\SiteBundle\Model\Artist\Artist;
use Tekstove\SiteBundle\Model\Artist\Exception\ArtistException;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistTest extends TestCase
{
    public function testGetArtistNotInitiated()
    {
        $this->expectException(ArtistException::class);
        $artist = new Artist();
        $artist->getAlbums();
    }
}
