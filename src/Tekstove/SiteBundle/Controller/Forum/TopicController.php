<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\CategoryGateway;

/**
 * TopicController
 * @Template()
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TopicController extends Controller
{
    public function listAction($categoryId)
    {
        $categoryGateway = $this->get('tekstove.gateway.forum.category');
        /* @car $categoryGateway CategoryGateway */
        $categoryGateway->setGroups([CategoryGateway::GROUP_LIST]);
        $categoryData = $categoryGateway->get($categoryId);
        
        $category = $categoryData['item'];
        
        return [
            'category' => $category,
        ];
    }
}
