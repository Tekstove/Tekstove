<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Forum\Category;

/**
 * Description of Category
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class CategoryGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/forum/category/';
    }
    
    public function find()
    {
        $data = parent::find();
        foreach ($data['items'] as &$categoryData) {
            $categoryData = new Category($categoryData);
        }
        unset($categoryData);
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $category = new Category($data['item']);
        return [
            'item' => $category,
        ];
    }
}
