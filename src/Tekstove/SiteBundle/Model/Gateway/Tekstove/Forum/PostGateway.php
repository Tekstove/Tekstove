<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Forum\Post;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * PostGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class PostGateway extends AbstractGateway
{
    const GROUP_USER = 'Forum_Post_User';
    const GROUP_TOPIC = 'Forum_Post_Topic';
    
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
    
    public function save(Post $post)
    {
        if ($post->getId()) {
            throw new \Exception("Not implemented");
        }
        
        $changeSet = [
            'text' => $post->getText(),
            'topic' => $post->getTopic()->getId(),
        ];
        
        try {
            $this->getClient()
                        ->post(
                            $this->getRelativeUrl(),
                            ['body' => json_encode($changeSet)]
                        );
        } catch (RequestException $e) {
            if ($e->getCode() != 400) {
                throw $e;
            }
            
            $validationException = new TekstoveValidationException($e->getMessage(), 0, $e);
            $errors = json_decode($e->getBody(), true);
            $validationException->setValidationErrors($errors);
            throw $validationException;
        }
    }
}
