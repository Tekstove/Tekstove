<?php

namespace Tekstove\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;

class ArtistController extends Controller
{

    /**
     * @Template()
     */
    public function browseAction(Request $request, $id)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway ArtistGateway */
        $artistGateway->setGroups(
            [
                ArtistGateway::GROUP_DETAILS,
                ArtistGateway::GROUP_ALBUMS,
            ]
        );
        $artistData = $artistGateway->get($id);
        $artist = $artistData['item'];
        $lyricGateway = $this->get("tesktove.gateway.lyric");
        /* @var $lyricGateway LyricGateway */
        $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
        $lyricGateway->addFilter('artist', $artist->getId());
        $lyricGateway->addOrder('title', 'ASC');
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $lyrics = $paginator->paginate(
            $lyricGateway,
            $request->query->getInt('lyricsPage', 1),
            30,
            [
                'pageParameterName' => 'lyricsPage',
            ]
        );
        return [
            'artist' => $artist,
            'lyrics' => $lyrics,
        ];
    }

    /**
     * @Template()
     */
    public function listAction($letter, Request $request)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway */
        $artistGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $artistGateway->addFilter('name', "{$letter}%", AbstractGateway::FILTER_LIKE);
        $artistGateway->addOrder('name', 'ASC');
        $artistGateway->setLimit(30);
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $pagination = $paginator->paginate(
            $artistGateway,
            $request->query->getInt('page', 1) /* page number */,
            30 /* limit per page */
        );
        
        return [
            'pagination' => $pagination,
        ];
    }
}
