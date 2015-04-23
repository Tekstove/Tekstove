<?php

use Tekstove\Artist;

class lyric {

	private $id;
	private $zaglavie_palno;
	private $zaglavie_sakrateno;
	private $up_id;
	private $text;
	private $text_bg;
	private $textTranslated = NULL;
	private $artist1;
	private $artist1_ime;
	private $artist2;
	private $artist2_ime;
	private $artist3;
	private $artist3_ime;
	private $artist4;
	private $artist4_ime;
	private $artist5;
	private $artist5_ime;
	private $artist6;
	private $artist6_ime;
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
	private $vidqna;
	private $populqrnost;
	private $pee_se_na;
	private $stil;
	private $cenzora;
	private $download;
	private static $lyricIdmax = NULL;


    public function get_Zaglavie_palno($bezhtml = false)
    {
        if ($bezhtml) {
            return $this->zaglavie_palno;
        } else {
            return htmlspecialchars($this->zaglavie_palno);
        }
    }

    public function get_Zaglavie_sakrateno($bezhtml = false)
    {
        if ($bezhtml) {
            return $this->zaglavie_sakrateno;
        }
        return htmlspecialchars($this->zaglavie_sakrateno);
    }

    public function getVideo_youtube_orig()
    {
        return $this->video_youtube_orig;
    }

    public function getVideo_metacafe()
    {
        return $this->video_metacafe;
    }

    public function getDownload($htmlspecial = true)
    {
        $return = $this->download;
        if ($htmlspecial) {
            $return = htmlspecialcharsX($return);
        }

        return $return;
    }

    public function __set($p, $s)
    {
        echo 'ГРЕШКА: сетваме на ' . htmlspecialchars($p) . ' = ' . htmlspecialchars($s);
        die;
    }

    public function __get($p)
    {
        echo 'ГРЕШКА: Взимане на ' . $p;
        die;
    }

    static public function videoc_vboxcode($a)
    {
        $a = preg_replace('|(.*)play\:([a-zA-Z0-9]*)[\#\&\?]{0,1}(.*)|iu', '$2', $a);
        return htmlspecialcharsX($a);
    }

    static public function videoc_metacafecode($a)
    {
        //  http://www.metacafe.com/watch/255204/cold_tell_me_why/
        //  http://www.metacafe.com/fplayer/255204/cold_tell_me_why.swf
        $a = preg_replace('|(.*)\.com\/watch\/([a-zA-Z0-9_])(\/)+$|iu', '$1.com/fplayer/$2.swf', $a);
        return htmlspecialcharsX($a);
    }

    static public function video_youtube($a)
    {
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

    public static function artist_name_ot_id($id, $bezhtmlspecial = 0)
    {
        $id = (integer) $id;
        if (!$id) {
            return "";
        }

        $pdo = PDOX::singleton();

        $sth = $pdo->prepare('SELECT `name` FROM `artists` WHERE `id` = ? LIMIT 1');
        $sth->execute(array($id));
        $pevec = $sth->fetch();

        if ($bezhtmlspecial) {
            return $pevec['name'];
        } else {
            return htmlspecialchars($pevec['name']);
        }
    }

    public function cenzora18()
    {

        if (isset($this->cenzora)) {
            return $this->cenzora;
        }

        $pdo = PDOX::singleton();

        $stm = $pdo->prepare("SELECT `id` FROM `lyric_18` WHERE `id` = ? ");
        $stm->bindParam(1, $this->id, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $this->cenzora = TRUE;
        } else {
            $this->cenzora = FALSE;
        }

        return $this->cenzora;
    }
    
    public function isCenzored() {
        return $this->cenzora18();
    }
    
    public function getForbidden()
    {
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

    public static function ezici()
    {
        return array(
            0 => '-----',
            1 => 'Български',
            2 => 'Английски',
            3 => 'Гръцки',
            4 => 'Сръбски',
            5 => 'Френски',
            6 => 'Руски',
            7 => 'Немски',
            8 => 'Италиански',
            9 => 'Испански',
            10 => 'Турски',
            11 => 'Македонски',
            12 => 'Румънски',
            13 => 'Хинди(Индийски)',
            14 => 'Унгарски',
            15 => 'Иврит',
            16 => 'Ирландски',
            17 => 'Португалски'
        );
    }

    public static function janrove($sas_html_elementi = NULL)
    {

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


        if (!$sas_html_elementi) {
            return $a;
        }

        $a['stilraphiphop'] = '<b>рап</b>';
        $a['stilhiphop'] = '&nbsp;&nbsp;&nbsp;хип-хоп';
        $a['stileastcoast'] = '&nbsp;&nbsp;&nbsp;East Coast';
        $a['stilskit'] = '&nbsp;&nbsp;&nbsp;скит';

        $a['stilrok'] = '<b>рок</b>';
        $a['stilrok_clas'] = '&nbsp;&nbsp;&nbsp;класически рок';
        $a['stilrok_alt'] = '&nbsp;&nbsp;&nbsp;алтернативен рок';
        $a['stilrok_hard'] = '&nbsp;&nbsp;&nbsp;хард рок';
        $a['stilpunk'] = '&nbsp;&nbsp;&nbsp;пънк';

        $a['stilmetal'] = '<b>метъл</b>';
        $a['stilmetal_heavy'] = '&nbsp;&nbsp;&nbsp;heavy metal';
        $a['stilmetal_power'] = '&nbsp;&nbsp;&nbsp;power metal';
        $a['stilmetal_death'] = '&nbsp;&nbsp;&nbsp;death metal';
        $a['stilmetal_nu'] = '&nbsp;&nbsp;&nbsp;new metal';
        $a['stilmetal_gothic'] = '&nbsp;&nbsp;&nbsp;gothic metal';
        $a['stilmetal_symphonic'] = '&nbsp;&nbsp;&nbsp;symphonic metal';
        $a['stilemo'] = '&nbsp;&nbsp;&nbsp;емо';

        $a['stilfolk'] = '<b>поп</b>';

        return $a;
    }

    static public function cenzora18_static($id)
    {

        return self::cenzora18($id);
    }

    public static function proveri_imq_li_pesen($pesen_id, $potrebitel_id)
    {

        $pdo = PDOX::singleton();

        $stm = $pdo->prepare('SELECT `id` FROM `lyric` WHERE `id` = ? LIMIT 1');
        $stm->bindValue(1, $pesen_id, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() > 0) {
            return;
        }

        $stm = $pdo->prepare('INSERT INTO `pm` (`ot`, `za`, `otnosno`, `text`) VALUES (?, ?, ?, ?) ');
        $stm->bindValue(1, 54, PDO::PARAM_INT);
        $stm->bindValue(2, $potrebitel_id, PDO::PARAM_INT);
        $stm->bindValue(3, 'Песента, която използваш за поздрав бе изтрита', PDO::PARAM_STR);
        $stm->bindValue(4, 'Песента, която използваш за поздрав бе изтрита, може да си избереш нова :)', PDO::PARAM_STR);
        $stm->execute();

        $stm = $pdo->prepare('UPDATE `users` SET `pozdrav` = 0 WHERE `id` = ? ');
        $stm->bindValue(1, $potrebitel_id, PDO::PARAM_INT);
        $stm->execute();
    }

    /**
	 * @deprecated
	 * 
	 * @param type $htmlSpecials
	 * @return type 
	 */
	public function getTextTranslated($htmlSpecials = true) {

		throw new Exception('method is deprecated');

		if ($this->textTranslated === NULL) {
			$this->textTranslated = googleTranslate($this->getText(false, false));

			$this->textTranslated = preg_replace('/^ +/m', '', $this->textTranslated);
			$this->textTranslated = preg_replace('/ +$/m', '', $this->textTranslated);

			$this->textTranslated = trim($this->textTranslated);
		}

		$return = $this->textTranslated;

		if ($htmlSpecials) {
			$return = htmlspecialcharsX($return);
		}

		return $return;
	}

    public static function getRandomLyric()
    {

        $pdo = PDOX::singleton();

        $maxId = Tekstove\Cache::get(CACHE_LYRIC_MAX_ID);

        if (!$maxId) {
            if (self::$lyricIdmax == NULL) {

                $stm = $pdo->prepare('SELECT MAX(`id`) FROM `lyric`');
                $stm->execute();
                $data = $stm->fetch();
                $maxId = $data[0];

				Tekstove\Cache::set(CACHE_LYRIC_MAX_ID, $maxId, 72000); // 20 часа
			}
		}

		$id = rand(0, $maxId);
        $stm = $pdo->prepare('SELECT * FROM `lyric` WHERE `id` >= ? LIMIT 1');
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

        $dataLyric = $stm->fetch();

        $lyric = new lyric($dataLyric);

        return $lyric;
    }

    /**
     * 
     * @return \lyric
     */
	public function updateCache() {
		$cacheFull = '';
		$cacheShort = '';

		for ($q = 1; $q <= 5; $q++) {
			if ($this->{'artist' . $q}) {
				$artistTemp = new \Tekstove\Artist\Artist($this->{'artist' . $q});
				$artistTempCache = $artistTemp->getName(false);
				if ($artistTemp->getNameAlternatives()) {
					$artistTempCache .= ' ' . $artistTemp->getNameAlternatives();
				}

				if ($q == 1) {
					$cacheShort .= $artistTemp->getName(false);
				} elseif ($q == 2) {
					$cacheShort .= ' и ' . $artistTemp->getName(false);
				}

				$cacheFull .= $artistTempCache;
			}
		}

		$cacheShort .= ' - ' . $this->getTitle(false);
		$cacheFull .= $this->getTitle(false);
		$cacheFull = preg_replace('/ /m', '', $cacheFull);

		$pdo = PDOX::singleton();
		$stm = $pdo->prepare("
			UPDATE
				`lyric`
			SET
				`zaglavie_sakrateno` = :cacheShort,
				`zaglavie_palno` = :cacheFull
			WHERE
				id = :id
		");
		$stm->bindValue('cacheShort', $cacheShort);
		$stm->bindValue('cacheFull', $cacheFull);
		$stm->bindValue('id', $this->getId(), PDO::PARAM_INT);
		
		$stm->execute();

		return $this;
	}

    public function increaseViews()
    {
        $pdo = PDOX::singleton();
        $stm = $pdo->prepare('INSERT INTO `lyric_views`(`lyric_id`, `ip`) VALUES(?, ?) ');
        $stm->bindValue(1, $this->getId(), PDO::PARAM_INT);
        $stm->bindValue(2, ip2long($_SERVER['REMOTE_ADDR']));
        $stm->execute();
    }

}
