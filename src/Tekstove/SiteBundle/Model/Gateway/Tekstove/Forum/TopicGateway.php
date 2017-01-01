<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Forum;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Forum\Topic;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

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
            
            try {
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
            } catch (RequestException $e) {
                if ($e->getCode() != 400) {
                    throw $e;
                }

                $validationException = new TekstoveValidationException($e->getMessage(), 0, $e);
                $errors = json_decode($e->getBody(), true);
                $validationException->setValidationErrors($errors);
                throw $validationException;
            }
            $parsedResponse = json_decode($response->getBody(), true);
            $topic->setId($parsedResponse['item']['id']);
        }
        
        return $topic;
    }
}
