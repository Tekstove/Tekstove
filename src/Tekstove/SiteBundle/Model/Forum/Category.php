<?php

namespace Tekstove\SiteBundle\Model\Forum;

/**
 * Category
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Category
{
    private $id;
    private $name;
    
    private $lastTopic;
    
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        
        if (isset($data['lastTopic'])) {
            $this->lastTopic = new Topic($data['lastTopic']);
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
    
    public function getLastTopic()
    {
        return $this->lastTopic;
    }
}
