<?php

namespace Tekstove\SiteBundle\Model\Forum;

/**
 * Post
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Post
{
    private $id;
    private $text;
    private $textHtml;
    private $datetime;
    private $topic;
    
    private $user;
    
    public function __construct(array $data = [])
    {
        $allowedSetFields = ['id', 'text', 'textHtml'];
        foreach ($allowedSetFields as $field) {
            if (isset($data[$field])) {
                $this->{$field} = $data[$field];
            }
        }
        
        if (isset($data['datetime'])) {
            $this->datetime = new \DateTime('@' . $data['datetime']);
        }
        
        if (isset($data['user'])) {
            $this->user = new \Tekstove\SiteBundle\Model\User\User($data['user']);
        }
        
        if (isset($data['topic'])) {
            $this->topic = new Topic($data['topic']);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }

    public function getTextHtml() {
        return $this->textHtml;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic(Topic $topic)
    {
        $this->topic = $topic;
    }
}
