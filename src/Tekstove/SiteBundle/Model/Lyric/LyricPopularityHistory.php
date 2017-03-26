<?php

namespace Tekstove\SiteBundle\Model\Lyric;

/**
 * Description of LyricPopularityHistory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricPopularityHistory
{
    private $lyric;
    private $popularity;

    public function __construct(array $data)
    {
        $this->lyric = new Lyric($data['lyric']);
        $this->popularity = $data['popularity'];
    }

    
    public function getLyric()
    {
        return $this->lyric;
    }

    public function getPopularity()
    {
        return $this->popularity;
    }
}
