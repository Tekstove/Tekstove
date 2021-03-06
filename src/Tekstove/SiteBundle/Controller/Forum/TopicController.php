<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\CategoryGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\TopicGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway;

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
        $topicGateway->setGroups(
            [
                TopicGateway::GROUP_LIST,
                TopicGateway::GROUP_LATEST_POST,
                TopicGateway::GROUP_POST_COUNT,
                PostGateway::GROUP_USER,
            ]
        );
        $topicGateway->addFilter('forumCategoryId', $category->getId());
        
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $topicPagination = $paginator->paginate(
            $topicGateway,
            $request->query->getInt('page', 1) /* page number */,
            15 /* limit per page */
        );

        $topicLinks = [];
        foreach ($topicPagination as $topic) {
            $lastPage = ceil(
                $topic->getPostCount() / 15
            );
            $topicLinks[$topic->getId()] = $this->generateUrl(
                'tekstove.site.forum.topic.view',
                [
                    'id' => $topic->getId(),
                    'page' => $lastPage,
                ]
            );
        }

        return [
            'category' => $category,
            'topicPagination' => $topicPagination,
            'topicLinks' => $topicLinks,
            'ads' => 1,
        ];
    }
    
    public function viewAction(Request $request, $id)
    {
        $topicGateway = $this->get('tekstove.gateway.forum.topic');
        /* @var $topicGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\TopicGateway */
        $topicGateway->setGroups([CategoryGateway::GROUP_DETAILS]);
        $topicData = $topicGateway->get($id);
        $topic = $topicData['item'];
        
        $postGateway = $this->get('tekstove.gateway.forum.post');
        /* @var $postGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway */
        $postGateway->setGroups([\Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway::GROUP_DETAILS]);
        $postGateway->addFilter('forumTopicId', $id);
        
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $postPagination = $paginator->paginate(
            $postGateway,
            $request->query->getInt('page', 1) /* page number */,
            15 /* limit per page */
        );
        
        return [
            'topic' => $topic,
            'postPagination' => $postPagination,
            'ads' => 1,
        ];
    }
    
    public function newAction(Request $request, $categoryId)
    {
        $categoryGateway = $this->get('tekstove.gateway.forum.category');
        /* @car $categoryGateway CategoryGateway */
        $categoryGateway->setGroups([CategoryGateway::GROUP_LIST]);
        $categoryData = $categoryGateway->get($categoryId);
        $category = $categoryData['item'];
        /* @var $postGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway */
        
        $topic = new \Tekstove\SiteBundle\Model\Forum\TopicNew();
        $topic->setCategory($category);
        
        $form = $this->createForm(
            \Tekstove\SiteBundle\Form\Type\Forum\Topic\TopicNewType::class,
            $topic
        );
        
        $form->add('Add', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $topicGateway = $this->get('tekstove.gateway.forum.topic');
            /* @var $topicGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\TopicGateway */
            
            try {
                $topicGateway->save($topic);
                return $this->redirectToRoute(
                    'tekstove.site.forum.topic.view',
                    ['id' => $topic->getId()]
                );
            } catch (TekstoveValidationException $e) {
                $formPopulator = new ArrayErrorPopulator();
                $formPopulator->addAlias('postText', 'text');
                $formPopulator->populateFormErrors($form, $e->getValidationErrors());
                dump($e->getValidationErrors());
            }
        }
        
        return [
            'category' => $category,
            'form' => $form->createView(),
        ];
    }
}
