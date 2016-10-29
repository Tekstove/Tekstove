<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Tekstove\SiteBundle\Form\Type\Forum\Post\PostType;
use Tekstove\SiteBundle\Model\Forum\Post;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\TopicGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

/**
 * PostController
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class PostController extends Controller
{
    /**
     * @Template()
     */
    public function listNewAction(Request $request)
    {
        $postGateway = $this->get('tekstove.gateway.forum.post');
        /* @var $postGateway PostGateway */
        
        $postGateway->addOrder('id', PostGateway::ORDER_DESC);
        $postGateway->setGroups([
            PostGateway::GROUP_LIST,
            PostGateway::GROUP_USER,
            PostGateway::GROUP_TOPIC,
        ]);
        
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $postGatewayPagination = $paginator->paginate(
            $postGateway,
            $request->query->getInt('page', 1) /* page number */,
            25 /* limit per page */
        );
        
        return [
            'postPagination' => $postGatewayPagination,
        ];
    }
    
    /**
     * @Template
     * @param Request $request
     * @param type $topicId
     */
    public function addAction(Request $request, $topicId)
    {
        // @TODO add check if user is logged
        $post = new Post();
        
        $topicGateway = $this->get('tekstove.gateway.forum.topic');
        /* @var $topicGateway TopicGateway */
        $topicGateway->setGroups([TopicGateway::GROUP_LIST]);
        $topicData = $topicGateway->get($topicId);
        $topic = $topicData['item'];
        
        $post->setTopic($topic);
        $form = $this->createCreateForm($post);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $post = $form->getData();
                $postGateway = $this->get('tekstove.gateway.forum.post');
                /* @var $postGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\PostGateway */
                try {
                    $postGateway->save($post);
                    return $this->redirectToRoute('tekstove.site.forum.topic.view', ['id' => $topicId]);
                } catch (TekstoveValidationException $e) {
                    $formPopulator = new ArrayErrorPopulator();
                    $formPopulator->populateFormErrors($form, $e->getValidationErrors());
                }
            }
        }
        
        return [
            'post' => $post,
            'form' => $form->createView(),
        ];
    }
    
    private function createCreateForm(Post $post)
    {
        $form = $this->createForm(
            PostType::class,
            $post
        );
        
        $form->add(
            'submit',
            \Symfony\Component\Form\Extension\Core\Type\SubmitType::class,
            [
                'attr' => [
                    'class' => 'btn-success'
                ]
            ]
        );
        
        return $form;
    }
}
