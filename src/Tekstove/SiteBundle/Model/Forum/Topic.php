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
    
    public $test = 'test';
    
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        
        if (!empty($data['user'])) {
            $this->user = new \Tekstove\SiteBundle\Model\User\User($data['user']);
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
}
