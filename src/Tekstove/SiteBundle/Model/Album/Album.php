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
    
    private $acl;
    
    private $sendByUser;
    private $lyrics;
    
    public function __construct(array $data = [])
    {
        $fields = [
            'id',
            'name',
            'image',
            'year',
            
            'acl',
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }
        
        if (isset($data['user'])) {
            $this->sendByUser = new \Tekstove\SiteBundle\Model\User\User($data['user']);
        }
        
        if (isset($data['lyrics'])) {
            foreach ($data['lyrics'] as $lyricData) {
                $this->lyrics[] = new AlbumLyric($lyricData);
            }
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
    
    public function getSendByUser()
    {
        return $this->sendByUser;
    }
    
    public function getLyrics()
    {
        return $this->lyrics;
    }
            
    /**
     * @param string $property
     * @return int|null
     */
    public function getAcl($property)
    {
        if (isset($this->acl[$property])) {
            return $this->acl[$property];
        }
        
        return null;
    }
}
