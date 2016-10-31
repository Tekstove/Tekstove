<?php

namespace Tekstove\SiteBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\PmGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;

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
}
