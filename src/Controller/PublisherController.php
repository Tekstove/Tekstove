<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Publisher\PublisherGateway;

class PublisherController extends AbstractController
{
    /**
     * @Template()
     */
    public function viewAction($id, Request $request, PublisherGateway $gateway, LyricGateway $lyricGateway, PaginatorInterface $paginator)
    {
        // this toV4 should be removed when we are fully migrated to v4
        $lyricGateway->setRelativeUrlToV4();
        $gateway->setGroups([PublisherGateway::GROUP_DETAILS]);
        $data = $gateway->get($id);
        $publisher = $data['item'];

        $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
        $lyricGateway->addOrder('id', LyricGateway::ORDER_DESC);
        $lyricGateway->addFilter('publisher', $id);

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
