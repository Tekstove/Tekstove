<?php

namespace Tekstove\SiteBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        /* @var $pmGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\PmGateway */
        
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
}
