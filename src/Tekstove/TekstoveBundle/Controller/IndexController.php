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
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
        $repo = $doctrine->getRepository('TekstoveBundle:Lyric');
        /* @var $repo \Tekstove\TekstoveBundle\Entity\LyricRepository */
        
        $latestQueryBuilder = $repo->createQueryBuilder('l');
        $repo->filterPublicAvailable($latestQueryBuilder);
        $latestQueryBuilder->addOrderBy('l.id', 'desc');
        $latestQueryBuilder->setMaxResults(10);
        $lastLyrics = $latestQueryBuilder->getQuery()->getResult();
        
        $lastTranslatedQueryBuilder = $repo->createQueryBuilder('l');
        $repo->filterPublicAvailable($lastTranslatedQueryBuilder);
        $lastTranslatedQueryBuilder->setMaxResults(10);
        $lastTranslatedQueryBuilder->andWhere($lastTranslatedQueryBuilder->expr()->isNotNull('l.textBg'));
        $lastTranslatedQueryBuilder->innerJoin('l.translations', 't');
        $lastTranslatedQueryBuilder->groupBy('l.id');
        $lastTranslatedQueryBuilder->orderBy('t.id', 'desc');
        $lastTranslated = $lastTranslatedQueryBuilder->getQuery()->getResult();

        $popularQueryBuilder = $repo->createQueryBuilder('l');
        $repo->filterPublicAvailable($popularQueryBuilder);
        $popularQueryBuilder->addOrderBy('l.popularity', 'desc');
        $popularQueryBuilder->setMaxResults(10);
        $popular = $popularQueryBuilder->getQuery()->getResult();
        
        $mostViewedQb = $repo->createQueryBuilder('l');
        $repo->filterPublicAvailable($mostViewedQb);
        $mostViewedQb->addOrderBy('l.views', 'desc');
        $mostViewedQb->setMaxResults(10);
        $mostViewed = $mostViewedQb->getQuery()->getResult();
        
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
