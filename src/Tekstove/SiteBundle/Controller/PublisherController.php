<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Publisher\PublisherGateway;

class PublisherController extends Controller
{
    /**
     * @Template()
     */
    public function viewAction($id)
    {
        $gateway = $this->get('app.gateway.v4.publisher');
        /* @var $gateway PublisherGateway */
        $gateway->setGroups([PublisherGateway::GROUP_DETAILS]);
        $data = $gateway->get($id);
        $publisher = $data['item'];

        return [
            'publisher' => $publisher,
        ];
    }
}