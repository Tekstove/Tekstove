<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $lyricGateway = $this->get('tesktove.gateway.lyric');
        $lyricGateway->setGroups([AbstractGateway::GROUP_LIST]);
        /* @var $lyricGateway \Tekstove\SiteBundle\Model\Gateway\Lyric\LyricGateway */
        $lyricGateway->addOrder('id', 'DESC');
        
        
        $lastLyricsResult = $lyricGateway->find();
        $lastLyrics = $lastLyricsResult['items'];
        
        $lyricLastTranslatedGateway = $this->get('tesktove.gateway.lyric');
        $lyricLastTranslatedGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $lyricLastTranslatedGateway->addFilter('textBg', 1, AbstractGateway::FILTER_NOT_NULL);
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
