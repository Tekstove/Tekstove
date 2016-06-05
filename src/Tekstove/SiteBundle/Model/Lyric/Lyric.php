<?php

namespace Tekstove\SiteBundle\Model\Lyric;

use Tekstove\SiteBundle\Model\User\User;
use Tekstove\SiteBundle\Model\Artist\Artist;
use Tekstove\SiteBundle\Model\Language;

/**
 * Lyric
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Lyric
{
    private $id;
    
    private $cacheTitleShort;
    
    /**
     *
     * @var Artist[]
     */
    private $artists = [];
    private $title;
    private $text;
    private $textBg;
    private $extraInfo;
    
    private $sendBy;
    private $sendByUser;
    
    private $download;
    
    private $videoYoutube;
    private $videoVbox7;
    
    private $languages = [];

    /**
     * @var int
     */
    private $popularity;
    
    /**
     * @var integer
     */
    private $views;
    
    /**
     * Allowed edit options
     * @var array
     */
    private $acl = [];
    
    /**
     * @var array
     */
    private $changedFields = [];
    
    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $fields = [
            'id',
            'title',
            'text',
            'textBg',
            'sendBy',
            'download',
            
            'videoYoutube',
            'videoVbox7',
            
            'views',
            'popularity',
            'cacheTitleShort',
            
            'acl',
        ];
        
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $this->{$field} = $data[$field];
        }
        
        if (!empty($data['artists'])) {
            foreach ($data['artists'] as $artistData) {
                $artist = new Artist($artistData);
                $this->addArtist($artist);
            }
        }
        
        if (!empty($data['languages'])) {
            foreach ($data['languages'] as $languageData) {
                $language = new Language($languageData);
                $this->addLanguage($language);
            }
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
    
    /**
     * @param Artist $artist
     */
    public function addArtist(Artist $artist)
    {
        $this->changedFields['artists'] = 'artists';
        $this->artists[] = $artist;
    }
    
    public function removeArtist(Artist $artistToRemove)
    {
        $this->changedFields['artists'] = 'artists';
        foreach ($this->artists as $artistKey => $existingArtist) {
            if ($existingArtist->getId() == $artistToRemove->getId()) {
                unset($this->artists[$artistKey]);
                return true;
            }
        }
    }
    
    public function clearArtists()
    {
        $this->changedFields['artists'] = 'artists';
        $this->artists = [];
    }

    /**
     * @return Artist[]
     */
    public function getArtists()
    {
        return $this->artists;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->changedFields['title'] = 'title';
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
        $this->changedFields['download'] = 'download';
        $this->download = $download;
    }
    
    public function getVideoYoutube()
    {
        return $this->videoYoutube;
    }

    public function setVideoYoutube($videoYoutube)
    {
        $this->changedFields['videoYoutube'] = 'videoYoutube';
        $this->videoYoutube = $videoYoutube;
    }
    
    public function getVideoVbox7()
    {
        return $this->videoVbox7;
    }

    public function setVideoVbox7($videoVbox7)
    {
        $this->changedFields['videoVbox7'] = 'videoVbox7';
        $this->videoVbox7 = $videoVbox7;
    }
    
    /**
     * @return Language[]
     */
    public function getLanguages()
    {
        return $this->languages;
    }
    
    public function addLanguage(Language $language)
    {
        $this->changedFields['languages'] = 'languages';
        $this->languages[] = $language;
    }
    
    public function removeLanguage(Language $languageToRemove)
    {
        foreach ($this->getLanguages() as $key => $langauage) {
            if ($langauage->getId() == $languageToRemove->getId()) {
                unset($this->languages[$key]);
                return true;
            }
        }
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
        $this->changedFields['sendByUser'] = 'sendByUser';
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
        $this->changedFields['text'] = 'text';
        $this->text = $text;
    }
    
    public function getTextBg()
    {
        return $this->textBg;
    }

    public function setTextBg($textBg)
    {
        $this->changedFields['textBg'] = 'textBg';
        $this->textBg = $textBg;
    }
    
    /**
     * @return string
     */
    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    /**
     * @param string $extraInfo
     */
    public function setExtraInfo($extraInfo)
    {
        $this->changedFields['extraInfo'] = 'extraInfo';
        $this->extraInfo = $extraInfo;
    }

    public function getViews()
    {
        return $this->views;
    }
    
    public function getPopularity()
    {
        return $this->popularity;
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
    
    /**
     * Check if fields is changed
     * @param string $field
     * @return boolean
     */
    public function isChanged($field)
    {
        if (isset($this->changedFields[$field])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @return array
     */
    public function getChangedFields()
    {
        return $this->changedFields;
    }
    
    /**
     * @return array
     */
    public function getChangeSet()
    {
        $return = [];
        foreach ($this->getChangedFields() as $field) {
            $getter = 'get' . $field;
            $value = $this->{$getter}();
            if (is_array($value)) {
                $return[$field] = [];
                foreach ($value as $nestedSet) {
                    $return[$field][] = $nestedSet->getId();
                }
            } else {
                $return[$field] = $value;
            }
        }
        
        return $return;
    }
}
