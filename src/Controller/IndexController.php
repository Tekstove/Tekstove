<?php

namespace App\Controller;

use App\Gateway\Tekstove\Lyric\LyricGatewayV4;
use Psr\Cache\CacheItemPoolInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends AbstractController
{
    public function indexAction(
        CacheItemPoolInterface $cache,
        LyricGatewayV4 $lyricGateway,
        LyricGatewayV4 $popularGateway,
        LyricGatewayV4 $lyricLastTranslatedGateway,
        LyricGatewayV4 $viewedGateway,
        AlbumGateway $albumGateway
    )
    {
        $defaultCacheInterval = new \DateInterval('PT5M');

        $cacheLatestLyric = $cache->getItem('index.lyric.latest10');
        if ($cacheLatestLyric->isHit()) {
            $lastLyrics = $cacheLatestLyric->get();
        } else {
            $cacheLatestLyric->expiresAfter($defaultCacheInterval);
            $lyricGateway->setGroups([AbstractGateway::GROUP_LIST]);
            /* @var $lyricGateway \Tekstove\SiteBundle\Model\Gateway\Lyric\LyricGateway */
            $lyricGateway->addOrder('id', 'DESC');

            $lastLyricsResult = $lyricGateway->find();
            $lastLyrics = $lastLyricsResult['items'];
            
            $cacheLatestLyric->set($lastLyrics);
            $cache->save($cacheLatestLyric);
        }
        
        $cacheLatestTranslatedLyric = $cache->getItem('index.lyric.latestTranslated10');
        if ($cacheLatestTranslatedLyric->isHit()) {
            $lastTranslated = $cacheLatestTranslatedLyric->get();
        } else {
            $cacheLatestTranslatedLyric->expiresAfter($defaultCacheInterval);
            $lyricLastTranslatedGateway->setGroups([AbstractGateway::GROUP_LIST]);
            $lyricLastTranslatedGateway->addFilter('textBg', 1, AbstractGateway::FILTER_NOT_NULL);
            $lyricLastTranslatedGateway->addOrder('textBgAdded', 'DESC');
            $lastTranslatedResult = $lyricLastTranslatedGateway->find();
            $lastTranslated = $lastTranslatedResult['items'];
            $cacheLatestTranslatedLyric->set($lastTranslated);
            $cache->save($cacheLatestTranslatedLyric);
        }
        
        $cachePopularLyric = $cache->getItem('index.lyric.popular10');
        if ($cachePopularLyric->isHit()) {
            $popular = $cachePopularLyric->get();
        } else {
            $cachePopularLyric->expiresAfter($defaultCacheInterval);
            $popularGateway->setGroups([AbstractGateway::GROUP_LIST]);
            $popularGateway->addOrder('popularity', 'DESC');
            $popularGateway->setLimit(19);
            $popularData = $popularGateway->find();
            $popular = $popularData['items'];
            $cachePopularLyric->set($popular);
            $cache->save($cachePopularLyric);
        }
        
        $cacheMostViewedLyric = $cache->getItem('index.lyric.viwed10');
        if ($cacheMostViewedLyric->isHit()) {
            $mostViewed = $cacheMostViewedLyric->get();
        } else {
            $cacheMostViewedLyric->expiresAfter($defaultCacheInterval);
            $viewedGateway->setGroups([AbstractGateway::GROUP_LIST]);
            $viewedGateway->addOrder('views', 'DESC');
            $viewedGateway->setLimit(19);
            $viewedData = $viewedGateway->find();
            $mostViewed= $viewedData['items'];
            $cacheMostViewedLyric->set($mostViewed);
            $cache->save($cacheMostViewedLyric);
        }
        
        $cacheAlbums = $cache->getItem('index.albums');
        if ($cacheAlbums->isHit()) {
            $lastAlbums = $cacheAlbums->get();
        } else {
            $cacheAlbums->expiresAfter($defaultCacheInterval);
            $albumGateway->setGroups([AbstractGateway::GROUP_LIST]);
            $albumGateway->addOrder('id', 'DESC');
            $albumGateway->setLimit(6);
            $albumsData = $albumGateway->find();

            $lastAlbums = $albumsData['items'];
            $cacheAlbums->set($lastAlbums);
            $cache->save($cacheAlbums);
        }

        return [
            'lastLyrics' => $lastLyrics,
            'lastTranslated' => $lastTranslated,
            'popular' => $popular,
            'mostViewed' => $mostViewed,
            'albums' => $lastAlbums,
            
            'ads' => 2,
        ];
    }
}
