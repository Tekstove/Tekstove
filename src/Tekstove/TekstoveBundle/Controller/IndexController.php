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
        // @TODO add order
        $lastTranslated = $lastTranslatedQueryBuilder->getQuery()->getResult();

        $popular = [];
        
        $mostViewd = [];
        
        $lastVoted = [];
        
        $lastAlbums = [];
        
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
