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

        $popularGateway = $this->get('tesktove.gateway.lyric');
        $popularGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $popularGateway->addOrder('popularity', 'DESC');
        $popularData = $popularGateway->find();
        $popular = $popularData['items'];
        
        $viewedGateway = $this->get('tesktove.gateway.lyric');
        $viewedGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $viewedGateway->addOrder('views', 'DESC');
        $viewedData = $viewedGateway->find();
        $mostViewed= $viewedData['items'];
        
        $albumGateway = $this->get('tekstove.gateway.album');
        /* @var $albumGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway */
        $albumGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $albumGateway->addOrder('id', 'DESC');
        $albumGateway->setLimit(6);
        $albumsData = $albumGateway->find();
        
        $lastAlbums = $albumsData['items'];
        
        return [
            'lastLyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewed,
            'albums' => $lastAlbums,
        ];
    }
}
