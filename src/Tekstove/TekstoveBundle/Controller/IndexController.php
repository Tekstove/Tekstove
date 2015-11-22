<?php

namespace Tekstove\TekstoveBundle\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tekstove\TekstoveBundle\Model\LyricQuery;
use Tekstove\TekstoveBundle\Model\AlbumQuery;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        
        $newestQuery = new LyricQuery();
        /* @var $newestQuery \Tekstove\TekstoveBundle\Model\LyricQuery */
        $newestQuery->orderById(Criteria::DESC);
        $newestQuery->limit(10);
        $lastLyrics = $newestQuery->find();
        
        $lastTranslatedQuery = new LyricQuery();

        $lastTranslatedQuery->filterByTextBg(null, Criteria::ISNOTNULL);
        $lastTranslatedQuery->orderById(Criteria::DESC);
        $lastTranslatedQuery->limit(10);
        $lastTranslated = $lastTranslatedQuery->find();

        $popularQuery = new LyricQuery();
        $popularQuery->orderByPopularity(Criteria::DESC);
        $popularQuery->limit(10);
        $popular = $popularQuery->find();
        
        $mostViewedQuery = new LyricQuery();
        $mostViewedQuery->orderByViews(Criteria::DESC);
        $mostViewedQuery->limit(10);
        $mostViewed = $mostViewedQuery->find();
        
        $lastVoted = [];
        
        $favoritesRandom = [];
        
        $albumsQuery = new AlbumQuery();
        $albumsQuery->orderById();
        $albumsQuery->limit(5);
        $lastAlbums = $albumsQuery->find();
        
        return [
            'lastlyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewed,
            'lastVoted' => $lastVoted,
            'favoritesRandom' => $favoritesRandom,
            'albums' => $lastAlbums,
        ];
    }
}
