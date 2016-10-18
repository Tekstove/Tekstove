<?php

namespace Tekstove\SiteBundle\Model\Forum;

/**
 * Description of Topic
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Topic
{
    private $id;
    private $name;
    
    
    private $user;
    
    private $category;
    
    private $latestPost;
    
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        
        if (!empty($data['user'])) {
            $this->user = new \Tekstove\SiteBundle\Model\User\User($data['user']);
        }
        
        if (!empty($data['category'])) {
            $this->category = new Category($data['category']);
        }
        
        if (!empty($data['latestPost'])) {
            $this->latestPost = new Post($data['latestPost']);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function getLatestPost()
    {
        return $this->latestPost;
    }
}
