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
    private $text;

    private $sendBy;
    private $sendByUser;

    /**
     * @var int
     */
    private $popularity;
    
    /**
     * @var integer
     */
    private $views;
    
    public function __construct($data = [])
    {
        $fields = [
            'id',
            
            'cacheTitleShort',
            
            'title',
            'text',
            'views',
            'popularity',
            
            'sendBy',
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
    
    public function getSendBy()
    {
        return $this->sendBy;
    }
    
    function getSendByUser()
    {
        return $this->sendByUser;
    }

    function setSendByUser($sendByUser)
    {
        $this->sendByUser = $sendByUser;
    }

            
    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getViews()
    {
        return $this->views;
    }
    
    public function getPopularity()
    {
        return $this->popularity;
    }
}
