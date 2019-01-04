<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

/**
 * LyricGateway for api version 4
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricV4Gateway extends AbstractGateway
{
    const FIELD_POPULARITY = 'popularity';
    const FIELD_VIEWS = 'views';
    
    const GROUP_POPULARITY = 'popularity';
    const GROUP_VIEWS = 'piews';
    const GROUP_MANUAL_CENSOR = 'manualCensor';
    
    protected function getRelativeUrl()
    {
        return '/v4/lyrics/';
    }
    
    public function find()
    {
        throw new \RuntimeException('not implemented');
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $lyric = new Lyric($data['item']);
        return [
            'item' => $lyric,
        ];
    }
    
    public function save(Lyric $lyric)
    {
        throw new \RuntimeException('not implemented');
    }
}
