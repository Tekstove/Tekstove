<?php

namespace Tekstove\TekstoveBundle\Model;

/**
 * Description of Album
 *
 * @author potaka
 */
class Album extends Entity
{
    private $manager;

    private $id;
    private $title;
    private $year;
    private $image;

    private $artist1id;
    
    public function __construct(array $data, Album\Manager $manager)
    {
        $this->manager = $manager;
        
        $this->id = (int) $data['id'];
        $this->title = $data['name'];
        $this->year = $data['year'];
        $this->image = $data['image'];
        
        $this->artist1id = $data['artist1id'];
    }

    public function getId()
    {
        return $this->id;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getYear()
    {
        return $this->year;
    }

    function getImage()
    {
        return $this->image;
    }
    
    public function getArtist1()
    {
        if (empty($this->artist1id)) {
            return null;
        }
        
        return $this->manager
                            ->getArtist($this->artist1id);
    }

}
