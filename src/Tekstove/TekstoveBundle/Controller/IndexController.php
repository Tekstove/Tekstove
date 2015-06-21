<?php

namespace Tekstove\TekstoveBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction() {
        $lyricManager = $this->get('tekstoveLyricManager');
        /* @var $lyricManager \Tekstove\TekstoveBundle\Model\Lyric\Manager  */
        
        $albumManager = $this->get('tekstoveAlbumManager');
        /* @var $albumManager \Tekstove\TekstoveBundle\Model\Album\Manager */
        
        $voteManager = $this->get('tekstoveVoteManager');
        /* @var $voteManager \Tekstove\TekstoveBundle\Model\Lyric\Vote\Manager */
        
        $lastLyricQuery = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        $lastLyricQuery->orderBy('id', \Propel\Runtime\ActiveQuery\Criteria::DESC);
        $lastLyricQuery->limit(10);
        $lastLyrics = $lastLyricQuery->find();
        
        $lastTranslated = $lyricManager->getBy([
            'onlyTranslated' => true,
            'order' => 'id',
            'orderType' => 'DESC',
        ]);
        
        $lastTranslatedQuery = \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create();
        $lastTranslatedQuery->where("text_bg IS NOT NULL");
        $lastTranslatedQuery->addDescendingOrderByColumn('id');
        $lastTranslatedQuery->limit(10);
        
        $popular = $lyricManager->getBy([
            'order' => 'populqrnost',
            'orderType' => 'DESC',
        ]);
        
        $mostViewd = $lyricManager->getBy([
            'order' => 'vidqna',
            'orderType' => 'DESC',
        ]);
        
        $latestVotes = $voteManager->getBy([
            'order' => 'id',
            'orderType' => 'DESC',
        ]);
        
        $latestVoteLyricIds = [];
        foreach ($latestVotes as $vote) {
            /* @var $vote \Tekstove\TekstoveBundle\Model\Lyric\Vote */
            $latestVoteLyricIds[] = $vote->getLyricId();
        }
        
        $lastVoted = $lyricManager->getBy([
            'ids' => $latestVoteLyricIds,
            'order' => 'id',
            'orderType' => 'DESC',
        ]);
        
        $lastAlbums = $albumManager->getLatest(5);
        
        return [
            'lastlyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'albums' => $lastAlbums,
            'mostViewed' => $mostViewd,
            'lastVoted' => $lastVoted,
        ];
    }
}
