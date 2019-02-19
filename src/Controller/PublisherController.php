<?php

namespace App\Controller;

use App\Gateway\Tekstove\V4\Lyric\LyricGateway;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Gateway\Tekstove\V4\Publisher\PublisherGateway;

class PublisherController extends AbstractController
{
    /**
     * @Template()
     */
    public function viewAction($id, Request $request, PublisherGateway $gateway, LyricGateway $lyricGateway, PaginatorInterface $paginator)
    {
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
