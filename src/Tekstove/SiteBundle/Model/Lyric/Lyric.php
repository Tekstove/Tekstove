<?php

namespace Tekstove\SiteBundle\Model\Lyric;

/**
 * Description of Lyric
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Lyric
{
    private $id;
    
    private $cacheTitleShort;
    
    private $title;
    
    public function __construct($data = [])
    {
        $fields = [
            'id',
            
            'cacheTitleShort',
            
            'title',
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
        return (int) $this->id;
    }
    
    public function getCacheTitleShort()
    {
        return $this->cacheTitleShort;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}
