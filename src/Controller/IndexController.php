<?php

namespace App\Controller;

use App\Gateway\Tekstove\V4\Lyric\LyricGateway;
use Psr\Cache\CacheItemPoolInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway;

/**
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class IndexController extends AbstractController
{
    public function indexAction(CacheItemPoolInterface $cache, LyricGateway $lyricGateway, LyricGateway $popularGateway, LyricGateway $lyricLastTranslatedGateway, LyricGateway $viewedGateway, AlbumGateway $albumGateway)
    {
        $defaultCacheInterval = new \DateInterval('PT5M');

        $cacheLatestLyric = $cache->getItem('index.lyric.latest10');
        if ($cacheLatestLyric->isHit()) {
            $lastLyrics = $cacheLatestLyric->get();
        } else {
            $cacheLatestLyric->expiresAfter($defaultCacheInterval);
            $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
            $lyricGateway->addFilter('onlyAuthorized', 1);
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
            $lyricLastTranslatedGateway->setGroups([LyricGateway::GROUP_LIST]);
            $lyricLastTranslatedGateway->addFilter('textBg', 1, LyricGateway::FILTER_NOT_NULL);
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
            $popularGateway->setGroups([LyricGateway::GROUP_LIST]);
            $popularGateway->addFilter('onlyAuthorized', 1);
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
            $viewedGateway->setGroups([LyricGateway::GROUP_LIST]);
            $viewedGateway->addFilter('onlyAuthorized', 1);
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
            $albumGateway->setGroups([AlbumGateway::GROUP_LIST]);
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
