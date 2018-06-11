<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

/**
 * Description of LyricPopularHistoryGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricPopularHistoryGateway extends AbstractGateway
{
    const FIELD_POPULARITY = 'popularity';
    const FIELD_VIEWS = 'views';

    const GROUP_POPULARITY = 'Popularity';
    const GROUP_VIEWS = 'Views';

    protected function getRelativeUrl()
    {
        return '/lyrics/popularity/history';
    }

    public function find()
    {
        $data = parent::find();
        $lyricsHisory = [];
        foreach ($data['items'] as $lyricData) {
            $lyricsHisory[] = new \Tekstove\SiteBundle\Model\Lyric\LyricPopularityHistory($lyricData);
        }

        $data['items'] = $lyricsHisory;
        return $data;
    }
}
