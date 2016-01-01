<?php

namespace Tekstove\SiteBundle\Controller;

use Propel\Runtime\ActiveQuery\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tekstove\SiteBundle\Model\LyricQuery;
use Tekstove\SiteBundle\Model\AlbumQuery;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $lyricGateway = $this->get('tesktove.gateway.lyric');
        /* @var $lyricGateway \Tekstove\SiteBundle\Model\Gateway\Lyric\LyricGateway */
        $lyricGateway->addOrder('id', 'DESC');
        
        
        $lastLyricsResult = $lyricGateway->find();
        $lastLyrics = $lastLyricsResult['items'];
        
        $lyricLastTranslatedGateway = $this->get('tesktove.gateway.lyric');
        $lyricLastTranslatedGateway->addFilter('textBg', 1, \Tekstove\SiteBundle\Model\Gateway\AbstractGateway::FILTER_NOT_NULL);
        $lyricLastTranslatedGateway->addOrder('textBgAdded', 'DESC');
        $lastTranslatedResult = $lyricLastTranslatedGateway->find();
        $lastTranslated = $lastTranslatedResult['items'];

        $popular = [];
        
        $mostViewed = [];
        
        $lastVoted = [];
        
        $favoritesRandom = [];
    
        $lastAlbums = [];
        
        return [
            'lastLyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewed,
            'lastVoted' => $lastVoted,
            'favoritesRandom' => $favoritesRandom,
            'albums' => $lastAlbums,
        ];
    }
}