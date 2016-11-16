<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Forum\Topic;
use Tekstove\SiteBundle\Model\Forum\Post;

/**
 * TopicGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TopicGateway extends AbstractGateway
{
    const GROUP_LATEST_POST = 'LatestPost';
    
    protected function getRelativeUrl()
    {
        return '/forum/topic';
    }
    
    public function find()
    {
        $data = parent::find();
        foreach ($data['items'] as &$topicData) {
            $topicData = new Topic($topicData);
        }
        unset($topicData);
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $category = new Topic($data['item']);
        return [
            'item' => $category,
        ];
    }
    
    public function save(Topic $topic)
    {
        if ($topic->getId()) {
            throw new \Exception("Not implemented");
        } else {
            if (!$topic instanceof \Tekstove\SiteBundle\Model\Forum\TopicNew) {
                throw new \Exception("Please pass TopicNew instead of Topic");
            }
            
            $response = $this->getClient()
                                ->post(
                                    $this->getRelativeUrl(),
                                    [
                                        'body' => json_encode([
                                            'name' => $topic->getName(),
                                            'postText' => $topic->getPostText(),
                                            'category' => $topic->getCategory()->getId(),
                                        ]),
                                    ]
                                );
            
            dump($response); die;
            
        }
    }
}
