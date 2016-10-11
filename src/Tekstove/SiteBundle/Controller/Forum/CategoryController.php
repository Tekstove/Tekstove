<?php

namespace Tekstove\SiteBundle\Controller\Forum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author po_taka <angel.koilov@gmail.com>
 * @Template()
 */
class CategoryController extends Controller
{
    public function listAction()
    {
        $gateway = $this->get('tekstove.gateway.forum.category');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum\CategoryGateway */
        $gateway->addOrder('order', 'ASC');
        $gateway->setLimit(99);
        $gateway->setGroups(['List', 'Details']);
        $categoriesData = $gateway->find();
        $categories = $categoriesData['items'];
        return [
            'categories' => $categories,
        ];
    }
}
