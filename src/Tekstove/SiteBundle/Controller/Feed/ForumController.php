<?php

namespace Tekstove\SiteBundle\Controller\Feed;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class ForumController extends Controller
{
    /**
     * @Template()
     */
    public function topicAction()
    {
        $postGateway = $this->get('tekstove.gateway.forum.post');
        /* @var $postGateway PostGateway */
        
        $postGateway->addOrder('id', PostGateway::ORDER_DESC);
        $postGateway->setGroups([
            PostGateway::GROUP_LIST,
            PostGateway::GROUP_USER,
            PostGateway::GROUP_TOPIC,
        ]);
        $postGateway->setLimit(50);
        
        $postData = $postGateway->find();
        $posts = $postData['items'];

        return [
            'posts' => $posts,
        ];
    }
}
