<?php

namespace Tekstove\SiteBundle\Model\Album;

/**
 * Description of AlbumLyric
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class AlbumLyric
{
    private $lyric;
    private $name;
    
    public function __construct($data)
    {
        if (isset($data['lyric'])) {
            $this->lyric = new \Tekstove\SiteBundle\Model\Lyric\Lyric($data['lyric']);
        }
        
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
    }

    public function getLyric()
    {
        return $this->lyric;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getLyricName()
    {
        if ($this->isLyric()) {
            return $this->getLyric()->getTitle();
        }
        
        return $this->getName();
    }
    
    public function isLyric()
    {
        return $this->lyric !== null;
    }
}
