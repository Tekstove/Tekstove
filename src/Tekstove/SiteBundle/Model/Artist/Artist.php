<?php

namespace Tekstove\SiteBundle\Model\Artist;

use Tekstove\SiteBundle\Model\Album\Album;
use Tekstove\SiteBundle\Model\Artist\Exception\ArtistException as Exception;

/**
 * Description of Artist
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Artist
{
    private $name;
    private $id;
    private $about;
    
    private $albums;

    private $acl;

    public function __construct($data = [])
    {
        $fields = [
            'id',
            'name',
            'about',
            'acl',
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }
        
        if (isset($data['albums'])) {
            $this->albums = [];
            foreach ($data['albums'] as $albumData) {
                $this->albums[] = new Album($albumData);
            }
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
    
    public function getAlbums()
    {
        if ($this->albums === null) {
            throw new Exception("Albums not set");
        }
        return $this->albums;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setAbout($about)
    {
        $this->about = $about;
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl(array $acl)
    {
        $this->acl = $acl;
    }

    public function isEditAllowed()
    {
        if (empty($this->acl)) {
            return false;
        }

        return true;
    }
}
