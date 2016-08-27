<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Album;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Album\Album;

/**
 * Description of AlbumGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class AlbumGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/albums';
    }
    
    public function find()
    {
        $data = parent::find();
        $albums = [];
        foreach ($data['items'] as $lyricData) {
            $albums[] = new Album($lyricData);
        }

        $data['items'] = $albums;
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $album = new Album($data['item']);
        return [
            'item' => $album,
        ];
    }
}
