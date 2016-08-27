<?php

namespace Tekstove\SiteBundle\Model\Album;

/**
 * Description of Album
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Album
{
    private $id;
    private $name;
    private $image;
    private $year;
    
    public function __construct(array $data = [])
    {
        $fields = [
            'id',
            'name',
            'image',
            'year',
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

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }
    
    public function getYear()
    {
        return $this->year;
    }
}