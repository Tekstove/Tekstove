<?php

namespace Tekstove\SiteBundle\Model\Lyric;

use Tekstove\SiteBundle\Model\User\User;

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
    private $textBg;

    private $sendBy;
    private $sendByUser;
    
    private $download;

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
            'title',
            'text',
            'textBg',
            'sendBy',
            'download',
            
            'views',
            'popularity',
            'cacheTitleShort',
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
    
    public function setId($id)
    {
        $this->id = $id;
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
    
    /**
     * @return string|null
     */
    public function getDownload()
    {
        return $this->download;
    }

    public function setDownload($download)
    {
        $this->download = $download;
    }

    /**
     * Return ID of the user who send the lyric
     * @return int|null
     */
    public function getSendBy()
    {
        return $this->sendBy;
    }
    
    /**
     * @return null|User
     */
    public function getSendByUser()
    {
        if ($this->getSendBy() && $this->sendByUser === null) {
            throw new \Exception('User not populated');
        }
        return $this->sendByUser;
    }
    
    /**
     * @param User $sendByUser
     */
    public function setSendByUser(User $sendByUser)
    {
        $this->sendByUser = $sendByUser;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function getTextBg()
    {
        return $this->textBg;
    }

    public function setTextBg($textBg)
    {
        $this->textBg = $textBg;
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
