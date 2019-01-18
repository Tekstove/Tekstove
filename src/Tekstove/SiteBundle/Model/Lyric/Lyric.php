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
    use \Tekstove\SiteBundle\Helper\ChangeSetable;
    
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
    private $extraInfoHtml;

    /**
     * @var bool
     * By default all lyrics are forbidden.
     * This is prevent us from accidentally displaying the lyric
     */
    private $forbidden = true;

    /**
     * @var int
     * By default status is "Not Available"
     */
    private $authorizationStatus = 1;
    
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
    
    private $censor;
    private $manualCensor;
    
    /**
     * Allowed edit options
     * @var array
     */
    private $acl = [];

    private $sendDate;
    
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
            'extraInfo',
            'extraInfoHtml',
            'sendBy',
            'download',
            'forbidden',
            'authorizationStatus',
            
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

        // api v3 sendBy is integer
        // api v4 sendBy is object(array)
        if (isset($data['sendBy'])) {
            if (is_numeric($data['sendBy'])) {
                $this->sendBy = $data['sendBy'];
            } elseif (is_array($data['sendBy'])) {
                $this->setSendByUser(new User($data['sendBy']));
                $this->sendBy = $this->getSendByUser()->getId();
            }
        }

        if (isset($data['sendDate'])) {
            $this->sendDate = new \DateTime();
            $this->sendDate->setTimestamp($data['sendDate']);
        }
        
        if (isset($data['censor'])) {
            $this->censor = (bool) $data['censor'];
        }

        if (isset($data['manualCensor'])) {
            $this->manualCensor = (bool) $data['manualCensor'];
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

    /**
     * @return mixed
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    public function getId()
    {
        return (int) $this->id;
    }
    
    public function setId($id)
    {
        $this->id = (int) $id;
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
     * @return bool
     */
    public function hasVideo()
    {
        if ($this->getVideoYoutube()) {
            return true;
        }
       
        if ($this->getVideoVbox7()) {
            return true;
        }

        return false;
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
     * @return string|null
     */
    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    /**
     *
     * @return string|null
     */
    public function getExtraInfoHtml()
    {
        return $this->extraInfoHtml;
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
    
    public function isCensor()
    {
        if ($this->censor === null) {
            throw new \RuntimeException("Field censor not set");
        }
        
        return $this->censor;
    }

    public function isManualCensor()
    {
        return $this->manualCensor;
    }

    public function getManualCensor()
    {
        return $this->isManualCensor();
    }

    public function setManualCensor($manualCensore)
    {
        $this->changedFields['manualCensor'] = 'manualCensor';
        $this->manualCensor = $manualCensore;
    }

    /**
     * @return bool
     */
    public function isForbidden()
    {
        return $this->forbidden;
    }

    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * @return int
     */
    public function getAuthorizationStatus(): int
    {
        return $this->authorizationStatus;
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
    
    public function isEditAllowed()
    {
        if (empty($this->acl)) {
            return false;
        }
        
        return true;
    }
}
