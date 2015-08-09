<?php

namespace Tekstove\TekstoveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $title;
    
    /**
     * @ORM\Column()
     */
    private $text;
    
    /**
     * @ORM\Column(name="text_bg")
     */
    private $textBg;
    
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
    
    public function getText() {
        return $this->text;
    }
    
    public function getTextBg() {
        return $this->textBg;
    }
    
    public function getCacheTitleShort() {
        return $this->cacheTitleShort;
    }

    public function setCacheTitleShort($cacheTitleShort) {
        $this->cacheTitleShort = $cacheTitleShort;
    }
    
    public function getViews() {
        return $this->views;
    }
    
    public function getPopularity() {
        return $this->popularity;
    }
}
