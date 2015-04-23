<?php

namespace Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of Language
 *
 * @author po_taka
 */
class Language
{

    private $id;
    private $name;

    function __construct($data)
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
