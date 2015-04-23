<?php

namespace Tekstove\Forum;

/**
 * Description of Category
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Category
{

    private $id;
    private $name;
    private $hidden;

    function __construct($data)
    {
        $this->id = (int) $data['id'];
        $this->hidden = (int) $data['hidden'];
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

    public function getHidden()
    {
        return $this->hidden;
    }

}
