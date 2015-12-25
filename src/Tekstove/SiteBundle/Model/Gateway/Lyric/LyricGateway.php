<?php

namespace Tekstove\SiteBundle\Model\Gateway\Lyric;

use Tekstove\SiteBundle\Model\Gateway\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

/**
 * Description of LyricGateway
 *
 * @author potaka
 */
class LyricGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/lyric';
    }
    
    public function find()
    {
        $data = parent::find();
        $lyrics = [];
        foreach ($data['items'] as $lyricData) {
            $lyrics[] = new Lyric($lyricData);
        }

        $data['items'] = $lyrics;
        return $data;
    }

   

}
