<?php

namespace Tekstove\TekstoveBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tekstove\TekstoveBundle\Model\Entity\LyricQuery;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $albumManager = $this->get('tekstoveAlbumManager');
        /* @var $albumManager \Tekstove\TekstoveBundle\Model\Album\Manager */
        
        $lastLyricQuery = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        $lastLyricQuery->orderBy('id', \Propel\Runtime\ActiveQuery\Criteria::DESC);
        $lastLyricQuery->limit(10);
        $lastLyrics = $lastLyricQuery->find();
        
        $lastTranslatedQuery = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        $lastTranslatedQuery->where("text_bg IS NOT NULL");
        $lastTranslatedQuery->addDescendingOrderByColumn('id');
        $lastTranslatedQuery->limit(10);
        $lastTranslated = $lastTranslatedQuery->find();

        $popularQuery = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        $popularQuery->addDescendingOrderByColumn('popularity');
        $popularQuery->limit(10);
        $popular = $popularQuery->find();
        
        $mostViewdQuery = LyricQuery::create();
        $mostViewdQuery->addDescendingOrderByColumn('views');
        $mostViewdQuery->limit(10);
        $mostViewd = $mostViewdQuery->find();
        
        $lastVotesQuery = LyricQuery::create();
        $lastVotesQuery->distinct();
        $lastVotesQuery->innerJoinVotes();
        $lastVotesQuery->addDescendingOrderByColumn(\Tekstove\TekstoveBundle\Model\Entity\Lyric\Map\VotesTableMap::TABLE_NAME . '.id');
        $lastVotesQuery->limit(10);
        $lastVoted = $lastVotesQuery->find();
        
        $albumQuery = \Tekstove\TekstoveBundle\Model\Entity\AlbumQuery::create();
        $albumQuery->addDescendingOrderByColumn('id');
        $albumQuery->limit(5);
        $lastAlbums = $albumQuery->find();
        
        return [
            'lastlyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewd,
            'lastVoted' => $lastVoted,
            'albums' => $lastAlbums,
        ];
    }
}
