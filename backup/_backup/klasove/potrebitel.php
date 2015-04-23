<?php
class potrebitel {
	private $acl;
    private $username;
    private $id;
    private $class;
	private $classCustomName;
    private $password;
	private $avatar;
    private $dataToArray;
	private $pozdrav = null;
	private $about = null;
	private $lyricsCount = null;
	private $translationCount = null;

    function __construct($a=null) {

	$this->acl = new Tekstove\Acl();
		
    $pdo = PDOX::singleton();

    if ($a){
     if(is_integer($a)){

            $stm = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :id LIMIT 1");
            
            $stm -> bindValue(':id', $a, PDO::PARAM_INT);
            $stm -> execute();

            if($stm->rowCount() ==0) {
                throw new Exception('User not found', 404);
            }

            $a = $stm->fetch();
        }




        if(is_array($a)){
        $this->dataToArray = $a;
        
        $this->id = (int) $a['id'];
        $this->username = $a['username'];
        $this->class= $a['class'];
        $this->password = $a['password'];
		$this->classCustomName = $a['classCustomName'];
		$this->avatar = $a['avatar'];
		if (isset ($a['pozdrav'])) {
			$this->pozdrav = $a['pozdrav'];
		}
		if (isset ($a['about'])) {
			$this->about = $a['about'];
		}
		
		if (isset ($a['br_pesni'])) {
			$this->lyricsCount = $a['br_pesni'];
		}
		
		if (isset ($a['prevodi'])) {
			$this->translationCount = $a['prevodi'];
		}

        }


        else {
            greshka('user name construct error ' . print_r($a, true));
        }
    } // ako ne e ot coocies

    else { //ot coocike

		zapis('ne e ovar6en klasa potrebitel ' . print_r($a, true) . 'backtrace: ' . print_r(debug_backtrace(), true) . 'server: ' . print_r($_SERVER, true));
            throw new Exception('User not found', 404);

            $c_username = mysql_real_escape_string($_COOKIE['ID_po_taka_l']);
            $c_pass = $_COOKIE['Key_po_taka_l'];

            $check = mysql_query("SELECT * FROM `users` WHERE `username` = '$c_username' LIMIT 1") or die(mysql_error());
            if (!mysql_num_rows($check)) {
                return null;
            }

            $info = mysql_fetch_array($check);
            //ако бисквитката има грешна парола ви пренасочва към входа
            if ($c_pass != $info['passwordcoockie']) {
                return null;
            }

            //иначе показва секцията за регистрирани потребители
            else {
                $this->id = (int) $info['ID'];
                $this->username = $info['username'];

                //$username_autoplay = $info['autoplay'];
            }
        }
    }
	
	/**
	 * 
	 * @param type $htmlSpecials
	 * @return string
	 */
    public function getUsername($htmlSpecials = true) {
		$return = $this->username;
		if ($htmlSpecials) {
			$return = htmlspecialcharsX($return);
		}
		
      return $return;
    }

    public function getId() {
        return $this->id;
    }


public static function idFromName($name)
{
	$pdo = PDOX::singleton();
	
	$stm = $pdo->prepare("SELECT `id` FROM `users` WHERE `username` = ?");
	$stm->bindValue(1, $name);
	$stm->execute();
	
	if($stm->rowCount() == 0 )
	{
		return false;
	}
	
	$stmData = $stm->fetch();
	
	return $stmData['id'];
	
}

public static function ime_ot_id($id, $bezhtml=0) {
        $pdo = PDOX::singleton();
        try {
            $stm = $pdo->prepare("SELECT `username` FROM `users` WHERE `id` = ? LIMIT 1");
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $stm->execute();

            if ($stm->rowCount() == 0)
                return NULL;

            $r = $stm->fetch();

            if ($bezhtml == 0)
                return htmlspecialchars($r['username']);
            else
                return $r['username'];
        } catch (Exception $e) {
            greshka($e);
        }
    }

    
    public static function addActivityPoints($usernameId, $points) {
        $pdo = PDOX::singleton();
        $stm = $pdo->prepare('UPDATE `users` SET `activity_points` = (`activity_points` + :points) WHERE `id` = :id');
        $stm->bindValue(':id', $usernameId, PDO::PARAM_INT);
        $stm->bindValue(':points', $points, PDO::PARAM_INT);
        $stm->execute();
    }
    
    public static function getActivityStarsHtml($points) {
        
        zapis('getActivityStarsHtml is deprecated');

        return '';
        
        
        if ($points < 10) {
            $stars = array();
        }
        elseif ($points < 100) {
            $stars = array('star1.0.png');
        } elseif ($points < 200) {
            $stars = array('star1.0.png', 'star1.0.png');
        } elseif ($points < 400) {
            $stars = array('star1.0.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 600) {
            $stars = array('star1.1.png');
        } elseif ($points < 800) {
            $stars = array('star1.1.png', 'star1.0.png');
        } elseif ($points < 1000) {
            $stars = array('star1.1.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 1300) {
            $stars = array('star1.1.png');
        } elseif ($points < 1600) {
            $stars = array('star1.1.png', 'star1.1.png');
        } elseif ($points < 1900) {
            $stars = array('star1.1.png', 'star1.1.png', 'star1.0.png');
        } elseif ($points < 2300) {
            $stars = array('star1.1.png', 'star1.1.png', 'star1.1.png');
        } elseif ($points < 2600) {
            $stars = array('star1.2.png');
        } elseif ($points < 2900) {
            $stars = array('star1.2.png', 'star1.0.png');
        } elseif ($points < 3200) {
            $stars = array('star1.2.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 3500) {
            $stars = array('star1.2.png', 'star1.1.png');
        } elseif ($points < 3800) {
            $stars = array('star1.2.png', 'star1.1.png', 'star1.1.png');
        } elseif ($points < 4100) {
            $stars = array('star1.2.png', 'star1.2.png');
        } elseif ($points < 4400) {
            $stars = array('star1.2.png', 'star1.2.png', 'star1.0.png');
        } elseif ($points < 4700) {
            $stars = array('star1.2.png', 'star1.2.png', 'star1.1.png');
        } elseif ($points < 5000) {
            $stars = array('star1.2.png', 'star1.2.png', 'star1.2.png');
        } elseif ($points < 5300) {
            $stars = array('star1.3.png', 'star1.0.png');
        } elseif ($points < 5600) {
            $stars = array('star1.3.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 5900) {
            $stars = array('star1.3.png', 'star1.1.png');
        } elseif ($points < 6200) {
            $stars = array('star1.3.png', 'star1.1.png', 'star1.0.png');
        } elseif ($points < 6500) {
            $stars = array('star1.3.png', 'star1.1.png', 'star1.1.png');
        } elseif ($points < 6800) {
            $stars = array('star1.3.png', 'star1.2.png');
        } elseif ($points < 7100) {
            $stars = array('star1.3.png', 'star1.2.png', 'star1.0.png');
        } elseif ($points < 7400) {
            $stars = array('star1.3.png', 'star1.2.png', 'star1.1.png');
        } elseif ($points < 7700) {
            $stars = array('star1.3.png', 'star1.2.png', 'star1.2.png');
        } elseif ($points < 8000) {
            $stars = array('star1.3.png', 'star1.3.png');
        } elseif ($points < 8300) {
            $stars = array('star1.3.png', 'star1.3.png', 'star1.0.png');
        } elseif ($points < 8600) {
            $stars = array('star1.3.png', 'star1.3.png', 'star1.1.png');
        } elseif ($points < 8900) {
            $stars = array('star1.3.png', 'star1.3.png', 'star1.2.png');
        } elseif ($points < 9200) {
            $stars = array('star1.3.png', 'star1.3.png', 'star1.3.png');
        } elseif ($points < 9500) {
            $stars = array('star1.4.png');
        } elseif ($points < 9750) {
            $stars = array('star1.4.png', 'star1.0.png');
        } elseif ($points < 10000) {
            $stars = array('star1.4.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 10500) {
            $stars = array('star1.4.png', 'star1.1.png');
        } elseif ($points < 11000) {
            $stars = array('star1.4.png', 'star1.1.png', 'star1.0.png');
        } elseif ($points < 11500) {
            $stars = array('star1.4.png', 'star1.1.png', 'star1.1.png');
        } elseif ($points < 12000) {
            $stars = array('star1.4.png', 'star1.2.png');
        } elseif ($points < 13500) {
            $stars = array('star1.4.png', 'star1.2.png', 'star1.0.png');
        } elseif ($points < 14000) {
            $stars = array('star1.4.png', 'star1.2.png', 'star1.1.png');
        } elseif ($points < 14500) {
            $stars = array('star1.4.png', 'star1.2.png', 'star1.2.png');
        } elseif ($points < 15000) {
            $stars = array('star1.4.png', 'star1.3.png',);
        } elseif ($points < 15500) {
            $stars = array('star1.4.png', 'star1.3.png', 'star1.0.png');
        } elseif ($points < 16000) {
            $stars = array('star1.4.png', 'star1.3.png', 'star1.1.png');
        } elseif ($points < 16500) {
            $stars = array('star1.4.png', 'star1.3.png', 'star1.2.png');
        } elseif ($points < 17000) {
            $stars = array('star1.4.png', 'star1.3.png', 'star1.3.png');
        } elseif ($points < 17500) {
            $stars = array('star1.4.png', 'star1.4.png');
        } elseif ($points < 18000) {
            $stars = array('star1.4.png', 'star1.4.png', 'star1.0.png');
        } elseif ($points < 18500) {
            $stars = array('star1.4.png', 'star1.4.png', 'star1.1.png');
        } elseif ($points < 19000) {
            $stars = array('star1.4.png', 'star1.4.png', 'star1.2.png');
        } elseif ($points < 19500) {
            $stars = array('star1.4.png', 'star1.4.png', 'star1.3.png');
        } elseif ($points < 20000) {
            $stars = array('star1.4.png', 'star1.4.png', 'star1.4.png');
        } elseif ($points < 20500) {
            $stars = array('star1.5.png');
        } elseif ($points < 21000) {
            $stars = array('star1.5.png', 'star1.0.png');
        } elseif ($points < 21500) {
            $stars = array('star1.5.png', 'star1.0.png', 'star1.0.png');
        } elseif ($points < 22000) {
            $stars = array('star1.5.png', 'star1.1.png');
        } elseif ($points < 22500) {
            $stars = array('star1.5.png', 'star1.1.png', 'star1.0.png');
        } elseif ($points < 23000) {
            $stars = array('star1.5.png', 'star1.1.png', 'star1.1.png');
        } else if ($points < 23500) {
            $stars = array('star1.5.png', 'star1.2.png');
        } else if ($points < 24000) {
            $stars = array('star1.5.png', 'star1.2.png', 'star1.0.png');
		} else if ($points < 24500) {
            $stars = array('star1.5.png', 'star1.2.png', 'star1.1.png');
		} else if ($points < 25000) {
            $stars = array('star1.5.png', 'star1.2.png', 'star1.2.png');
		} else if ($points < 25500) {
            $stars = array('star1.5.png', 'star1.3.png');
		} else if ($points < 26000) {
            $stars = array('star1.5.png', 'star1.3.png', 'star1.0.png');
		} else if ($points < 26500) {
            $stars = array('star1.5.png', 'star1.3.png', 'star1.1.png');
		} else if ($points < 27000) {
            $stars = array('star1.5.png', 'star1.3.png', 'star1.2.png');
		} else if ($points < 27500) {
			$stars = array('star1.5.png', 'star1.3.png', 'star1.3.png');
		} else if ($points < 28000) {
			$stars = array('star1.5.png', 'star1.4.png',);
		} else if ($points < 28500) {
			$stars = array('star1.5.png', 'star1.4.png', 'star1.0.png');
		} else if ($points < 29000) {
			$stars = array('star1.5.png', 'star1.4.png', 'star1.1.png');
		} else if ($points < 29500) {
			$stars = array('star1.5.png', 'star1.4.png', 'star1.2.png');
		} else if ($points < 30000) {
			$stars = array('star1.5.png', 'star1.4.png', 'star1.3.png');
		} else if ($points < 30500) {
			$stars = array('star1.5.png', 'star1.4.png', 'star1.4.png');
		} else if ($points < 31000) {
			$stars = array('star1.5.png', 'star1.5.png');
		} else if ($points < 31500) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.0.png');
		} else if ($points < 32000) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.1.png');
		} else if ($points < 32500) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.2.png');
		} else if ($points < 33000) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.3.png');
		} else if ($points < 33500) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.4.png');
		} else if ($points < 34000) {
			$stars = array('star1.5.png', 'star1.5.png', 'star1.5.png');
		} else if ($points < 34500) {
			$stars = array('star1.6.png');
		} else if ($points < 35000) {
			$stars = array('star1.6.png', 'star1.0.png');
		} else if ($points < 35500) {
			$stars = array('star1.6.png', 'star1.0.png', 'star1.0.png');
		} elseif ($points < 36000) {
			$stars = array('star1.6.png', 'star1.1.png', 'star1.0.png');
		} elseif ($points < 36500) {
			$stars = array('star1.6.png', 'star1.1.png', 'star1.1.png' );
		} elseif ($points < 37000) {
			$stars = array('star1.6.png', 'star1.2.png');
		} elseif ($points < 37500) {
			$stars = array('star1.6.png', 'star1.2.png', 'star1.0.png');
		} elseif ($points < 38000) {
			$stars = array('star1.6.png', 'star1.2.png', 'star1.1.png');
		} elseif ($points < 38500) {
			$stars = array('star1.6.png', 'star1.2.png', 'star1.2.png');
		} elseif ($points < 39000) {
			$stars = array('star1.6.png', 'star1.3.png');
		} elseif ($points < 39500) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.0.png');
		} elseif ($points < 40000) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.1.png');
		} elseif ($points < 40500) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.2.png');
		} elseif ($points < 41000) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.3.png');
		} elseif ($points < 41500) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.1.png');
		} elseif ($points < 42000) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.2.png');
		} elseif ($points < 42500) {
			$stars = array('star1.6.png', 'star1.3.png', 'star1.3.png');
		} elseif ($points < 43000) {
			$stars = array('star1.6.png', 'star1.4.png');
		} elseif ($points < 43500) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.0.png');
		} elseif ($points < 44000) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.1.png');
		} elseif ($points < 44500) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.2.png');
		} elseif ($points < 45000) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.3.png');
		} elseif ($points < 45500) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.3.png');
		} elseif ($points < 46000) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.3.png');
		} elseif ($points < 46500) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.3.png');
		} elseif ($points < 47000) {
			$stars = array('star1.6.png', 'star1.4.png', 'star1.4.png');
		} elseif ($points < 47500) {
			$stars = array('star1.6.png', 'star1.5.png');
		} elseif ($points < 48000) {
			$stars = array('star1.6.png', 'star1.5.png', 'star1.0.png');
		} elseif ($points < 48500) {
			$stars = array('star1.6.png', 'star1.5.png', 'star1.1.png');
		} elseif ($points < 49000) {
			$stars = array('star1.6.png', 'star1.5.png', 'star1.2.png');
		} elseif ($points < 49500) {
			$stars = array('star1.6.png', 'star1.5.png', 'star1.3.png');
		} elseif ($points < 50000) {
			$stars = array('star1.6.png', 'star1.5.png', 'star1.5.png');
		} elseif ($points < 51000) {
			$stars = array('star1.6.png', 'star1.6.png');
		} elseif ($points < 52000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.0.png');
		} elseif ($points < 53000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.1.png');
		} elseif ($points < 54000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.2.png');
		} elseif ($points < 55000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.3.png');
		} elseif ($points < 56000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.4.png');
		} elseif ($points < 57000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.5.png');
		} elseif ($points < 58000) {
			$stars = array('star1.6.png', 'star1.6.png', 'star1.6.png');
		} elseif ($points < 59000) {
			$stars = array('star1.7.png');
		} elseif ($points < 60000) {
			$stars = array('star1.7.png', 'star1.0.png');
		} elseif ($points < 61000) {
			$stars = array('star1.7.png', 'star1.0.png', 'star1.0.png');
		} elseif ($points < 62000) {
			$stars = array('star1.7.png', 'star1.1.png');
		} elseif ($points < 63000) {
			$stars = array('star1.7.png', 'star1.1.png', 'star1.0.png');
		} elseif ($points < 64000) {
			$stars = array('star1.7.png', 'star1.1.png', 'star1.1.png');
		} elseif ($points < 65000) {
			$stars = array('star1.7.png', 'star1.2.png');
		} elseif ($points < 66000) {
			$stars = array('star1.7.png', 'star1.2.png', 'star1.0.png');
		} elseif ($points < 67000) {
			$stars = array('star1.7.png', 'star1.2.png', 'star1.1.png');
		} elseif ($points < 68000) {
			$stars = array('star1.7.png', 'star1.2.png', 'star1.2.png');
		} elseif ($points < 69000) {
			$stars = array('star1.7.png', 'star1.3.png');
		} elseif ($points < 70000) {
			$stars = array('star1.7.png', 'star1.3.png', 'star1.0.png');
		} elseif ($points < 71000) {
			$stars = array('star1.7.png', 'star1.3.png', 'star1.1.png');
		} elseif ($points < 72000) {
			$stars = array('star1.7.png', 'star1.3.png', 'star1.2.png');
		} elseif ($points < 73000) {
			$stars = array('star1.7.png', 'star1.3.png', 'star1.3.png');
		} elseif ($points < 74000) {
			$stars = array('star1.7.png', 'star1.4.png');
		} elseif ($points < 75000) {
			$stars = array('star1.7.png', 'star1.4.png', 'star1.0.png');
		} elseif ($points < 76000) {
			$stars = array('star1.7.png', 'star1.4.png', 'star1.1.png');
		} elseif ( true || $points < 77000) {
			$stars = array('star1.7.png', 'star1.4.png', 'star1.2.png');
		}


		$return = '';
        foreach ($stars as $s) {
            $return .= '<img src="/images/stars/'.$s.'" class="activity_star" />';
        }
        
        return $return;
        
    }


	public function getRankAsText() {
		
		if ($this->getClassCustomName() == '') {
			return $this->getRankFromClassAsText();
		} else {
			return $this->getClassCustomName();
		}
		
	}

    private function getRankFromClassAsText() {
	
		switch ($this->getClass()) {
			case 0:
				return "Потребител";
			case 1:
				return "Потребител&#43;";
			case 2:
			case 3:
			case 4:
				return "Потребител<b>&#43;&#43;</b>";
			case 5:
				return '<span class="potrebiteli_vip">VIP</span>';
			case 6:
				return '<span class="potrebiteli_vip">V.I.P.</span>';
			case 7:
				return '<span class="potrebiteli_vip"><u>V.I.P.</u></span>';
			case 9:
				return 'Новинар';
			case 10:
				return "<font color=\"green\">Модератор</font>";
			case 20:
				return "<font color=\"blue\">Модератор</font>";

			case 50:
				return "<font color=\"red\">Модератор</font>";
			case 100:
				return "---";
		}
	}


public static function zadaljitelno_lognat($class){

    if(!$class ) {        ?>
<html>
<head>

<link rel="stylesheet" href="<?php echo SITE_STYLE_CSS; ?>" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>грешка</title>
</head>
<body>
    <table class="glavna"><tr>
<td colspan=3>
    <table class="top"><tr>
		<td>
			<div class="menu_logo"><a href="index.php" title="Начална страница"><img src="images/logo_1.jpg" ALT="Начало"></a></div>
		</td>

		<td class="top_menu_table">
			<span class="top_menu_gore_dqsno">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Начало</a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="razgledai.php">Разгледай</a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;<a href="albumi.php">Албуми</a><br><br>
			</span>
		</td>

		<td class="top_menu_table">
			<span class="top_menu_gore_dqsno">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="search.php">Търсачка</a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;<a href="forum.php">Форум</a>
			</span>
		</td>

		<td class="top_menu_table">
			<span class="top_menu_gore_dqsno">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="uploadliryc.php">Изпрати Tекст</a><br>
				&nbsp;&nbsp;&nbsp;&nbsp;<a href="albumsend.php">Изпрати Албум</a>
			</span>
		</td>


		</tr>
	</table><table class="top">
		<tr>
		<td align="left" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div class="topmenu">
				<a href="index.php">Начало</a>&nbsp;
				<a href="razgledai.php">Разгледай</a>&nbsp;
				<a href="albumi.php">Албуми</a>&nbsp;
				<a href="search.php">Търсачка</a>&nbsp;
				<a href="forum.php">Форум</a>&nbsp;
			</div>
		</td>
		<td align="center">
			<div class="topmenu">
				<a href="uploadliryc.php" class="top">Изпрати Tекст</a>&nbsp;
				<a href="albumsend.php">Изпрати Албум</a>&nbsp;
			</div>
		</td>
		</tr>
		<tr><td colspan=3 align="center"><div class="prelivane_bukvi_header"></div>

                 <div class="bukvi" id="bukvi_bg"></div>

                    </td>
		</tr>
		</table></td>
	</tr><tr><td class="nomer2" colspan=3>

<div class="cherta_po_bukvite"></div>
	<table style="width:100%"><tr><td align="left">

</td></tr></table>
</td></tr>
<tr><td class="sadarjanie">

    Моля първо влез в профила си
    <a href="login.php"><b>Вход</b></a>
    

<?php
die();
}


} //zadaljitelno_lognat


public function getClass()
{
return $this->class;
}

public function getPassword() {
    return $this->password;
}

public function getDataToArray() {
    return $this->dataToArray;
}


public function getClassCustomName() {
	return $this->classCustomName;
}

public function getPozdrav() {
	return $this->pozdrav;
}

public function getAbout($options = array()) {
	if (!empty ($options)) {
		zapis('potrebitel::getAbout incompleted');
	}

	$data = htmlspecialchars($this->about);
	$data = nl2br($data);
	
	return $data;
}

/**
 * 
 * @param type $htmlSpecials
 * @return type
 */
public function getAvatar($htmlSpecials = true) {
	$return = $this->avatar;
	if ($htmlSpecials) {
		$return = htmlspecialcharsX($return);
	}
	return $return;
}

public function getLyricsCount() {
	if ($this->lyricsCount === null) {
		throw new Exception('not implemented');
	}
	
	return $this->lyricsCount;
}

public function getTranslationCount() {
	if ($this->translationCount === null) {
		throw new Exception('not implemented');
	}
	 
	return $this->translationCount;
}


/**
 * 
 * @return \Tekstove\Acl
 */
public function getAcl() {
	return $this->acl;
}




} //class