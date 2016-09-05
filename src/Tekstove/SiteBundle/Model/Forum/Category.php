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
    
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
