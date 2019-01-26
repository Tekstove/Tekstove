<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Publisher\PublisherGateway;

class PublisherController extends Controller
{
    /**
     * @Template()
     */
    public function viewAction($id, Request $request)
    {
        $gateway = $this->get('app.gateway.v4.publisher');
        /* @var $gateway PublisherGateway */
        $gateway->setGroups([PublisherGateway::GROUP_DETAILS]);
        $data = $gateway->get($id);
        $publisher = $data['item'];

        $lyricGateway = $this->get('tesktove.gateway.v4.lyric');
        /* @var $lyricGateway LyricGateway */
        $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
        $lyricGateway->addOrder('id', LyricGateway::ORDER_DESC);
        $lyricGateway->addFilter('publisher', $id);

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
            'publisher' => $publisher,
            'lyrics' => $lyrics,
        ];
    }
}
