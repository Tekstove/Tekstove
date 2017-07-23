<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

/**
 * Description of AlbumController
 *
 * @author po_taka <angel.koilov@gmail.com>
 * @Template()
 */
class AlbumController extends Controller
{
    public function viewAction($id)
    {
        $albumGateway = $this->get('tekstove.gateway.album');
        /* @var $albumGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway */
        $albumGateway->setGroups(
            [
                AbstractGateway::GROUP_DETAILS,
                AbstractGateway::GROUP_ACL,
                \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway::GROUP_DETAILS,
            ]
        );
        $albumData = $albumGateway->get($id);
        
        return [
            'album' => $albumData['item'],
            
            'ads' => true,
        ];
    }
}
