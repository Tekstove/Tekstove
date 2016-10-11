<?php

namespace Tekstove\SiteBundle\Model\Album;

/**
 * Album
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
    private $artists;
    
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
            $this->lyrics = [];
            foreach ($data['lyrics'] as $lyricData) {
                $this->lyrics[] = new AlbumLyric($lyricData);
            }
        }
        
        if (isset($data['artists'])) {
            $this->artists = [];
            foreach ($data['artists'] as $artistData) {
                $this->artists[] = new \Tekstove\SiteBundle\Model\Artist\Artist($artistData);
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
    
    public function getArtists()
    {
        return $this->artists;
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
