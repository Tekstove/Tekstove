<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Artist\Artist;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/artists';
    }
    
    public function find()
    {
        $data = parent::find();
        $artists = [];
        foreach ($data['items'] as $artistData) {
            $artists[] = new Artist($artistData);
        }

        $data['items'] = $artists;
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $lyric = new Artist($data['item']);
        return [
            'item' => $lyric,
        ];
    }
}
