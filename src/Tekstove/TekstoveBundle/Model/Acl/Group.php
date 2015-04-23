<?php

namespace Tekstove\TekstoveBundle\Model\Acl;

/**
 * Description of Group
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Group
{

    CONST IMAGE_PATH = '/images/badges/';

    private $id;
    private $name;
    private $image;

    function __construct($data)
    {
        $this->id = (int) $data['id'];
        $this->image = (string) $data['image'];
        $this->name = (string) $data['name'];
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
        return static::IMAGE_PATH . $this->image;
    }

}
