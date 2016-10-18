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
    private $datetime;
    
    private $user;
    
    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->text = $data['text'];
        $this->datetime = new \DateTime('@' . $data['datetime']);
        
        if (isset($data['user'])) {
            $this->user = new \Tekstove\SiteBundle\Model\User\User($data['user']);
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
    
    public function getDatetime()
    {
        return $this->datetime;
    }
    
    public function getUser()
    {
        return $this->user;
    }
}
