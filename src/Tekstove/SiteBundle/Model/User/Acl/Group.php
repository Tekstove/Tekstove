<?php

namespace Tekstove\SiteBundle\Model\User\Acl;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class Group
{
    private $id;
    private $name;
    private $image;
    
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->image = $data['image'];
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }
}
