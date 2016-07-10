<?php

namespace Tekstove\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

class ArtistController extends Controller
{

    /**
     * @Template()
     */
    public function browseAction($id)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway */
        $artistGateway->setGroups([AbstractGateway::GROUP_DETAILS]);
        $artistData = $artistGateway->get($id);
        $lyrics = [];
        $albums = [];
        return [
            'artist' => $artistData['item'],
            'lyrics' => $lyrics,
            'albums' => $albums,
        ];
    }

    /**
     * @Template()
     */
    public function listAction($letter, Request $request)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway */
        $artistGateway->setGroups(AbstractGateway::GROUP_LIST);
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
