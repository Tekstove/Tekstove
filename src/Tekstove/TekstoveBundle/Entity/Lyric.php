<?php

namespace Tekstove\TekstoveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as SymfonyValidator;

use Tekstove\TekstoveBundle\Entity\Language;

/**
 * Lyric
 *
 * @ORM\Table(name="lyric")
 * @ORM\Entity(repositoryClass="Tekstove\TekstoveBundle\Entity\LyricRepository")
 */
class Lyric
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @SymfonyValidator\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column()
     * @SymfonyValidator\NotBlank()
     */
    private $text;

    /**
     * @ORM\Column(name="text_bg")
     */
    private $textBg;

    /**
     * @ORM\Column(name="extra_info", nullable=true)
     */
    private $extraInfo;

    /**
     * @ORM\OneToMany(targetEntity="Tekstove\TekstoveBundle\Entity\Lyric\Translation", mappedBy="lyric")
     */
    private $translations;

    /**
     * @ORM\ManyToMany(targetEntity="Tekstove\TekstoveBundle\Entity\Language")
     */
    private $languages;

    /**
     * @ORM\ManyToOne(targetEntity="Tekstove\TekstoveBundle\Entity\User")
     * @ORM\JoinColumn(name="uploaded_by", referencedColumnName="id", nullable=true)
     */
    private $uploadedBy;

    /**
     * @ORM\Column(name="video_youtube")
     */
    private $videoYoutube;

    /**
     * @ORM\Column(name="video_metacafe")
     */
    private $videoMetaCafe;

    /**
     * @ORM\Column(name="video_vbox7");
     */
    private $videoVbox7;

    /**
     * @ORM\Column(name="cache_title_short")
     */
    private $cacheTitleShort;

    /**
     * @ORM\Column()
     */
    private $views;

    /**
     * @ORM\Column()
     */
    private $popularity;

    public function __construct()
    {
        $this->views = 0;
        $this->popularity = 0;
        $this->languages = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Lyric
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getTextBg()
    {
        return $this->textBg;
    }

    public function setTextBg($text)
    {
        $this->textBg = $text;
    }

    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    public function setExtraInfo($extraInfo)
    {
        $this->extraInfo = $extraInfo;
    }

    public function getCacheTitleShort()
    {
        return $this->cacheTitleShort;
    }

    public function setCacheTitleShort($cacheTitleShort)
    {
        $this->cacheTitleShort = $cacheTitleShort;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function getPopularity()
    {
        return $this->popularity;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function getUploadedBy()
    {
        return $this->uploadedBy;
    }

    public function setUploadedBy($uploadedBy)
    {
        $this->uploadedBy = $uploadedBy;
    }

    public function getVideoYoutube()
    {
        return $this->videoYoutube;
    }

    public function setVideoYoutube($videoYoutube)
    {
        $this->videoYoutube = $videoYoutube;
    }

    public function getVideoMetaCafe()
    {
        return $this->videoMetaCafe;
    }

    public function setVideoMetaCafe($videoMetaCafe)
    {
        $this->videoMetaCafe = $videoMetaCafe;
    }

    public function getVideoVbox7()
    {
        return $this->videoVbox7;
    }

    public function setVideoVbox7($videoVbox7)
    {
        $this->videoVbox7 = $videoVbox7;
    }

    public function getLanguages()
    {
        return $this->languages;
    }

    public function addLanguage(Language $language)
    {
        $this->languages[] = $language;
    }

    public function removeLanguage(Language $language)
    {
        $this->languages->removeElement($language);
    }
}
