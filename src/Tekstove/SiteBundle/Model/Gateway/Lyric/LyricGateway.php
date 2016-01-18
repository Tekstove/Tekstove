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
    protected function getListRelativeUrl()
    {
        return '/lyric/list';
    }
    
    protected function getGetRelativeUrl()
    {
        return '/lyric/get/';
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
    
    public function get($id)
    {
        $data = parent::get($id);
        $lyric = new Lyric($data['item']);
        return [
            'item' => $lyric,
        ];
    }
    
}
