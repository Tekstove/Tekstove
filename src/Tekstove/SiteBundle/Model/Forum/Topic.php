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

    private $postCount;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
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

            if (isset($data['postCount'])) {
                $this->postCount = $data['postCount'];
            }
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
        
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }
        
    public function getLatestPost()
    {
        return $this->latestPost;
    }

    public function getPostCount()
    {
        return $this->postCount;
    }
}
