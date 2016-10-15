<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\CategoryGateway;

/**
 * TopicController
 * @Template()
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TopicController extends Controller
{
    public function listAction(Request $request, $categoryId)
    {
        $categoryGateway = $this->get('tekstove.gateway.forum.category');
        /* @car $categoryGateway CategoryGateway */
        $categoryGateway->setGroups([CategoryGateway::GROUP_LIST]);
        $categoryData = $categoryGateway->get($categoryId);
        $category = $categoryData['item'];
        
        $topicGateway = $this->get('tekstove.gateway.forum.topic');
        /* @var $topicGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\TopicGateway */
        $topicGateway->setGroups(CategoryGateway::GROUP_LIST);
        $topicGateway->addFilter('forumCategoryId', $category->getId());
        
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $topicPagination = $paginator->paginate(
            $topicGateway,
            $request->query->getInt('page', 1) /* page number */,
            15 /* limit per page */
        );
        
        return [
            'category' => $category,
            'topicPagination' => $topicPagination,
        ];
    }
}
