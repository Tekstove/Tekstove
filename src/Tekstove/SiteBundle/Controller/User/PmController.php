<?php

namespace Tekstove\SiteBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\PmGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\User\Pm;
use Tekstove\SiteBundle\Form\Type\User\PmType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Tekstove\SiteBundle\Model\User\User;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

/**
 * Description of PmController
 *
 * @author potaka
 */
class PmController extends Controller
{
    /**
     * @Template()
     */
    public function listAction(Request $request)
    {
        $pmGateway = $this->get('tekstove.gateway.user.pm');
        /* @var $pmGateway PmGateway */
        
        $pmGateway->setGroups(['List']);
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $pagination = $paginator->paginate(
            $pmGateway,
            $request->query->getInt('page', 1),
            15
        );
        
        return [
            'pmPagination' => $pagination,
        ];
    }

    /**
     *
     * @param int $id
     *
     * @Template()
     */
    public function viewAction($id)
    {
        $pmGateway = $this->get('tekstove.gateway.user.pm');
        /* @var $pmGateway PmGateway */
        $pmGateway->setGroups([PmGateway::GROUP_DETAILS]);
        $pmData = $pmGateway->get($id);
        $pm = $pmData['item'];
        /* @var $pm \Tekstove\SiteBundle\Model\User\Pm */
        
        // mark pm as read
        try {
            if (!$pm->getRead()) {
                $pmGatewayMarkread = $this->get('tekstove.gateway.user.pm');
                /* @var $pmGatewayMarkread PmGateway */
                $pm->setRead(true);
                $pmGatewayMarkread->save($pm);
            }
        } catch (RequestException $e) {
            $logger = $this->get('logger');
            $logger->critical('Can\'t mark pm as read', ['exception' => $e]);
        }
        
        return [
            'pm' => $pm,
        ];
    }
    
    /**
     * @Template()
     */
    public function addAction(Request $request, $toUserId, $title)
    {
        // @TODO user must be logged.
        // Anyway, api will not validate request....
        
        $pm = new Pm();
        $pm->setTitle($title);
        $pm->setUserTo(new User(['id' => (int) $toUserId]));
        
        $form = $this->createCreateForm($pm);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pmGateway = $this->get('tekstove.gateway.user.pm');
            /* @var $pmGateway PmGateway */
            try {
                $pmGateway->save($pm);
                return $this->redirectToRoute('userPmList');
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    private function createCreateForm(Pm $pm)
    {
        $form = $this->createForm(
            PmType::class,
            $pm
        );
        $form->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn-success',
                ],
            ]
        );
        
        return $form;
    }
}
