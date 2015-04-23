<?php

namespace Tekstove\TekstoveBundle\Model;

/**
 * Description of Artist
 *
 * @author potaka
 */
class Artist extends Entity
{

    private $id;
    private $name;
    private $forbidden;

    function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->forbidden = (bool) $data['forbidden'];
    }

    public function getForbidden()
    {
        return $this->forbidden;
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
