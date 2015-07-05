<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\Model\Artist;
use Tekstove\TekstoveBundle\Model\Lyric\Exception;

class Lyric extends Entity
{

    private $id;
    private $zaglavie_palno;
    private $zaglavie_sakrateno;
    private $upId;
    private $text;
    private $text_bg;
    private $artist1;
    private $artist2;
    private $artist3;
    private $artist4;
    private $artist5;
    private $artist6;
    private $title;
    private $album1;
    private $album2;
    private $video;
    private $video_vbox7;
    private $video_vbox7_orig;
    private $video_youtube;
    private $video_youtube_orig;
    private $video_metacafe;
    private $video_metacafe_orig;
    private $image;
    private $podnovena;
    private $ip_upload;
    private $dopylnitelnoinfo;
    private $glasa;
    private $views;
    private $popularity;
    private $language;
    private $languageId;
    private $stil;
    private $cenzora;
    private $download;
    private $manager;

    /**
     * 
     * @param type $a
     * @param Manager $lyricManager
     * @throws Exception
     * @throws Tekstove\LyricException
     */
    function __construct($a, Lyric\Manager $lyricManager) {
        $this->manager = $lyricManager;
        
        if (is_array($a)) {
            $this->id = (int) $a['id'];

            $this->video = $a['video']; // strib
            $this->video_vbox7 = $a['video_vbox7']; // strib
            $this->video_vbox7_orig = $a['video_vbox7_orig']; // strib
            $this->video_youtube = $a['video_youtube'];
            $this->video_youtube_orig = $a['video_youtube_orig'];
            $this->video_metacafe = $a['video_metacafe'];

            $this->zaglavie_palno = $a['zaglavie_palno'];
            $this->zaglavie_sakrateno = $a['zaglavie_sakrateno'];

            $this->artist1 = $a['artist1'];
            $this->artist2 = $a['artist2'];
            $this->artist3 = $a['artist3'];
            $this->artist4 = $a['artist4'];
            $this->artist5 = $a['artist5'];
            $this->artist6 = $a['artist6'];

            $this->title = $a['title'];
            $this->text = $a['text'];
            $this->text_bg = $a['text_bg'];

            $this->album1 = (int) $a['album1'];
            $this->album2 = (int) $a['album2'];

            $this->dopylnitelnoinfo = $a['dopylnitelnoinfo'];

            $this->download = $a['download'];

            $this->image = $a['image'];
            $this->glasa = $a['glasa'];
            $this->languageId = (int) $a['pee_se_na'];

            $this->podnovena = $a['podnovena'];
            $this->popularity = $a['popularity'];
            $this->views = $a['views'];

            $this->upId = (int) $a['up_id'];

            $this->ip_upload = $a['ip_upload'];
        } elseif ($a === null) {
            // new lyric
        } else {
            throw new Exception('not implemented');
        }

    }

    public function getStil() {
        return $this->stil;
    }

    public function getId() {
        return $this->id;
    }

    public function getUpId() {
        if ($this->upId === 0) {
            return null;
        }
        return $this->upId;
    }
    
    public function getUploader() {
        if ($this->getUpId() === null) {
            return null;
        }
        
        $user = $this->manager->getUserNamanger()->findById($this->upId);
        
        return $user;
    }

    public function getText() {
        $return = $this->text;
        return $return;
    }
    
    /**
     * 
     * @param string $textParam
     */
    public function setText($textParam) {
        $text = trim($textParam);
        if (empty($text)) {
            $ex = new Exception\ValidationException('полетo "текст" не може да е празно');
            $ex->setField('text');
            throw $ex;
        }
        
        $event = new Lyric\Event\ChangeText($this);
        $this->manager->getEventDispatcher()->dispatch(Lyric\Events::CHANGE_TEXT ,$event);
        
        $this->text = $text;
    }

    public function getTextBg() {
        $return = $this->text_bg;
        return $return;
    }

    public function getArtist1() {
        if ($this->artist1) {
            $obj = $this->manager->getArtist($this->artist1);
            return $obj;
        }
        return null;
    }

    public function getArtist2() {
        if ($this->artist2) {
            $obj = $this->manager->getArtist($this->artist2);
        } else {
            $obj = null;
        }
        return $obj;
    }

    public function getArtist3() {
        if ($this->artist3) {
            $obj = $this->manager->getArtist($this->artist3);
        } else {
            $obj = null;
        }
        return $obj;
    }

    public function getArtist4() {
        if ($this->artist4) {
            $obj = $this->manager->getArtist($this->artist4);
        } else {
            $obj = null;
        }
        return $obj;
    }

    public function getArtist5() {
        if ($this->artist5) {
            $obj = $this->manager->getArtist($this->artist5);
        } else {
            $obj = null;
        }
        return $obj;
    }

    public function getArtist6() {
        if ($this->artist6) {
            $obj = $this->manager->getArtist($this->artist6);
        } else {
            $obj = null;
        }
        return $obj;
    }

    public function getTitle() {
        return $this->title;
    }
    
    function setTitle($titleP) {
        $title = trim($titleP);
        if (empty($title)) {
            $ex = new Exception\ValidationException('Заглавието не може да е празно');
            $ex->setField('title');
            throw ($ex);
        }
        
        $this->title = $title;
    }

    
    public function getAlbum1() {
        return $this->album1;
    }

    public function getAlbum2() {
        return $this->album2;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getVideo_vbox7() {
        return $this->video_vbox7;
    }

    public function getVideo_youtube() {
        return $this->video_youtube;
    }

    public function get_Zaglavie_palno() {
        return $this->zaglavie_palno;
    }

    public function getNameShort() {
        return $this->zaglavie_sakrateno;
    }

    public function getVideo_metacafe() {
        return $this->video_metacafe;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPodnovena() {
        return $this->podnovena;
    }

    public function getDopylnitelnoinfo() {
        $return = $this->dopylnitelnoinfo;
        return $return;
    }

    public function getVotes() {
        return $this->glasa;
    }

    public function getViews() {
        return $this->views;
    }

    public function getPopularity() {
        return $this->popularity;
    }

    public function getLanguageId() {
        return $this->languageId;
    }
    
    public function getLanguage() {
        if ($this->language) {
            $return = $this->language;
        }
        elseif (!$this->getLanguageId()) {
            $return = null;
        } else {
            $return = $this->manager->getLanguage($this->getLanguageId());
            $this->language = $return;
        }
        
        return $return;
    }

    public function getDownload() {
        $return = $this->download;
        return $return;
    }

    static public function videoc_vboxcode($a) {
        $a = preg_replace('|(.*)play\:([a-zA-Z0-9]*)[\#\&\?]{0,1}(.*)|iu', '$2', $a);
        return htmlspecialcharsX($a);
    }

    static public function videoc_metacafecode($a) {
        //  http://www.metacafe.com/watch/255204/cold_tell_me_why/
        //  http://www.metacafe.com/fplayer/255204/cold_tell_me_why.swf
        $a = preg_replace('|(.*)\.com\/watch\/([a-zA-Z0-9_])(\/)+$|iu', '$1.com/fplayer/$2.swf', $a);
        return htmlspecialcharsX($a);
    }

    static public function video_youtube($a) {
        //$a = preg_replace('/watch\?v=/iu', 'v/', $a);
        $a = preg_replace('/^.*v\/([a-zA-Z0-9\-_]{5,}).*$/iu', '$1', $a);
        $a = preg_replace('/^.*\?v\=([a-zA-Z0-9\-_]{5,}).*$/iu', '$1', $a);
        $a = preg_replace('/^.*\.be\/([a-zA-Z0-9\-_]{5,}).*$/iu', '$1', $a);
        $a = preg_replace('/^.*\/embed\/([a-zA-Z0-9\-_]{5,}).*$/iu', '$1', $a);
        if (!preg_match('@^[a-zA-Z0-9\-_]+$@i', $a)) {
            $a = '';
        }
        $a = htmlspecialcharsX($a);
        return $a;
    }


    public function isCenzored() {
        // @TODO
        return false;
    }

    public function getForbidden() {
        if ($this->getArtist1()) {
            $artist1 = new Artist($this->getArtist1());
            if ($artist1->getForbidden()) {
                return true;
            }
        }

        if ($this->getArtist2()) {
            $artist2 = new Artist($this->getArtist2());
            if ($artist2->getForbidden()) {
                return true;
            }
        }

        if ($this->getArtist3()) {
            $artist3 = new Artist($this->getArtist3());
            if ($artist3->getForbidden()) {
                return true;
            }
        }

        if ($this->getArtist4()) {
            $artist4 = new Artist($this->getArtist4());
            if ($artist4->getForbidden()) {
                return true;
            }
        }

        if ($this->getArtist5()) {
            $artist5 = new Artist($this->getArtist5());
            if ($artist5->getForbidden()) {
                return true;
            }
        }

        return false;
    }


    public static function janrove() {

        $a = array(
            'stilraphiphop' => 'рап',
            'stilhiphop' => 'хип-хоп',
            'stileastcoast' => 'East Coast',
            'stilskit' => 'скит',
            'stilelektronna' => 'електронна',
            'stilelectronica' => 'Electronica',
            'stilrok' => 'рок',
            'stilrok_clas' => 'класически рок',
            'stilrok_alt' => 'алтернативен рок',
            'stilrok_hard' => 'хард рок',
            'stilpunk' => 'пънк',
            'stildisko' => 'диско',
            'stillatam' => 'латиноамерисканска',
            'stilsamba' => 'Самба',
            'stiltango' => 'Танго',
            'stilsalsa' => 'Салса',
            'stilklasi' => 'класическа',
            'stildetski' => 'детска',
            'stilfolk' => 'поп',
            'stilpopfolk' => 'Поп фолк',
            'stilchalga' => 'чалга',
            'stildance' => 'dance',
            'stilRnB' => 'RnB',
            'stilmetal' => 'метъл',
            'stilmetal_heavy' => 'heavy metal',
            'stilmetal_power' => 'power metal',
            'stilmetal_death' => 'death metal',
            'stilmetal_nu' => 'new metal',
            'stilmetal_gothic' => 'gothic metal',
            'stilmetal_symphonic' => 'symphonic metal',
            'stilemo' => 'емо',
            'stilsoundtrack' => 'soundtrack',
            'stilsoul' => 'soul',
            'stilnew_rave' => 'newrave',
            'stilreggae' => 'reggae',
            'stilkantri' => 'кънтри',
            'stilbreakbeat' => 'breakbeat',
            'stilbigbeat' => 'bigbeat',
            'stiljaz' => 'джаз',
            'stilblus' => 'блус',
            'stilnarodna' => 'народна',
            'stilska' => 'ска'
        );


        return $a;
    }


}
