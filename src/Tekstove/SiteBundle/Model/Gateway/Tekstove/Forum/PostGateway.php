<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Forum\Post;

/**
 * PostGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class PostGateway extends AbstractGateway
{
    const GROUP_USER = 'Forum_Post_User';
    
    protected function getRelativeUrl()
    {
        return '/forum/post';
    }
    
    public function find()
    {
        $data = parent::find();
        foreach ($data['items'] as &$topicData) {
            $topicData = new Post($topicData);
        }
        unset($topicData);
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $category = new Post($data['item']);
        return [
            'item' => $category,
        ];
    }
}
