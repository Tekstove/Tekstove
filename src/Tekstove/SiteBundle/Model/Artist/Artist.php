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

    public function __construct($data = [])
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
