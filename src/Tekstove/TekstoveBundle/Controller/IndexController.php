<?php

namespace Tekstove\TekstoveBundle\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        
        $lyricQuery = $this->get('tekstove.model.lyric.query');
        /* @var $lyricQuery \Tekstove\TekstoveBundle\Model\LyricQuery */
        $newestQuery = $lyricQuery->create();
        /* @var $newestQuery \Tekstove\TekstoveBundle\Model\LyricQuery */
        $newestQuery->orderById(Criteria::DESC);
        $newestQuery->limit(10);
        $lastLyrics = $newestQuery->find();
        
        $lastTranslatedQuery = $lyricQuery->create();
        $lastTranslatedQuery->filterByText(null, Criteria::ISNOTNULL);
        $lastTranslatedQuery->orderById(Criteria::DESC);
        $lastTranslatedQuery->limit(10);
        $lastTranslated = $lastTranslatedQuery->find();

        
        $popular = [];
        
        $mostViewed = [];
        
        $lastVoted = [];
        
        $lastAlbums = [];
        
        return [
            'lastlyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewed,
            'lastVoted' => $lastVoted,
            'albums' => $lastAlbums,
        ];
    }
}
