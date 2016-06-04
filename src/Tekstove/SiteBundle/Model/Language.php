<?php

namespace Tekstove\SiteBundle\Model;

/**
 * Description of Language
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Language
{

    private $id;
    private $name;

    public function __construct($data)
    {
        $fields = [
            'id',
            'name',
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
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
}
