<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author po_taka <angel.koilov@gmail.com>
 * @Template()
 */
class CategoryController extends Controller
{
    public function listAction(Request $request)
    {
        $gateway = $this->get('tekstove.gateway.forum.category');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\CategoryGateway */
        $gateway->setGroups(['List']);
        $categoriesData = $gateway->find();
        $categories = $categoriesData['items'];
        return [
            'categories' => $categories,
        ];
    }
}
