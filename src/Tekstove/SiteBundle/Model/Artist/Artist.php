<?php

namespace Tekstove\SiteBundle\Model\Artist;

/**
 * Description of Artist
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Artist
{

    private $name;
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
