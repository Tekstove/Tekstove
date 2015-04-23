<?php

/**
 * Description of ban
 *
 * @author po_taka
 */
class ban {

	/**
	 *
	 * @param string $ip 192.168.11.1
	 * @param int $minutes
	 * @param string $username 
	 * @param string $comment
	 */
	public static function newBanIP($ip, $minutes, $username = NULL, $comment = NULL) {
		$pdo = PDOX::singleton();
		$ip = ip2long($ip);
		if ($ip === false) {
			greshka('invalid IP ' . $ip);
		}

		$stm = $pdo->prepare('INSERT INTO `bans`(`ip`, `date`, `comment`) VALUES(:ip, :date, :comment)');
		$stm->bindValue(':ip', $ip);

		$date = new DateTime();
		$date->add(DateInterval::createFromDateString($minutes . ' minute'));

		$stm->bindValue(':date', $date->format('Y-m-d H:i:s'));

		if (empty($comment)) {
			$stm->bindValue(':comment', NULL, PDO::PARAM_NULL);
		} else {
			$stm->bindValue(':comment', $comment);
		}

		$stm->execute();
	}

	public static function newBanCookie($time) {
		$value = uniqid('tekstove_');
		$value .= strtotime($time);
		setcookie('tekstove_sssopis', $value, time() + 60 * 60 * 24 * 30, '/');
	}

	/**
	 *
	 * @return boolean|\Tekstove\Ban 
	 */
	public static function isCookieBan() {
		if (!isset($_COOKIE['tekstove_sssopis'])) {
			return false;
		}

		$time = (int) mb_strcut($_COOKIE['tekstove_sssopis'], 22);
		if ($time <= 0 || $time < strtotime("now")) {
			return false;
		}

		$time = date('Y-m-d H:i:s', $time);
		$ban = new Tekstove\Ban();
		$ban->setDate($time);
		return $ban;
	}

	public static function banUser($userId, $time) {
		$pdo = pdox::singleton();
		$stm = $pdo->prepare("
			UPDATE
				`users`
			SET
				`banned` = :time
			WHERE
				`id` = :id
				AND `banned` < :time
			");
		$stm->bindValue('id', $userId . PDO::PARAM_INT);
		$stm->bindValue('time', $time);
		$stm->execute();
	}

	/**
	 *
	 * @return \Tekstove\Ban|boolean|false 
	 */
	public static function isIpBanned() {
		$pdo = pdox::singleton();
		$stm = $pdo->prepare('SELECT * FROM `bans` WHERE `ip` = ? AND `date` > CURRENT_TIMESTAMP LIMIT 1');
		$stm->bindValue(1, ip2long($_SERVER['REMOTE_ADDR']));
		$stm->execute();
		if ($stm->rowCount() > 0) {
			$stm = $stm->fetch();
			return new Tekstove\Ban($stm);
		}
		return false;
	}

	public static function isIpBannedExternalDataBase() {
        
        if ($_SERVER['REMOTE_ADDR'] == '31.211.159.46') {
            return null;
        }

        if (isset($_SESSION['ip_checked']) && $_SESSION['ip_checked']) {
			return false;
		}

		$url = 'http://www.stopforumspam.com/api?ip=' . $_SERVER['REMOTE_ADDR'] . '&f=xmldom&confidence&unix';
		
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 1500);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1500);

		$result = curl_exec($ch);
		curl_close($ch);

		if ($result === false) {
			zapis($result . ' няма валидна информация, curl фаил');
			return null;
		}

        try {
            $xml = new SimpleXMLElement($result);
            if ($xml->success != '1') {
                zapis($result . ' няма валидна информация');
                return null;
            }

            if (!isset($xml->ip[0], $xml->ip[0]->appears)) {
                zapis($result . ' няма валидна информация');
                return null;
            }

            if ($xml->ip[0]->appears == 'yes' || $xml->ip[0]->appears == '1') {

                if (!isset($xml->ip[0]->confidence)) {
                    zapis($result . ' няма валидна информация');
                    return null;
                }

                if ((float)$xml->ip[0]->confidence >= 20) {
                    zapis('баннед фром стопФорумСпам ' . print_r($_SERVER, true));
                    $ban = new Tekstove\Ban();
                    $ban->comment = 'banned in http://www.stopforumspam.com/';
                    $ban->setDate(date('Y-m-d H:i:s', strtotime('+2 hours')));
                    return $ban;
                } else {
                    zapis('confidence < 20 стопФорумСпам ' . print_r($_SERVER, true));
                }
            }

            $_SESSION['ip_checked'] = true;
            return false;
        } catch (\Exception $e) {
            zapis($e->getMessage());
            return null;
        }
	}

	/**
	 *
	 * @return boolean|\Tekstove\Ban 
	 */
	public static function isUserBanned() {
		if (!isset($_SESSION['banned']) || $_SESSION['banned'] < date('Y-m-d H:i:s')) {
			return false;
		}

		$ban = new Tekstove\Ban();
		$ban->setDate($_SESSION['banned']);
		return $ban;
	}

	/**
	 * return true if is banned
	 *  false if not
	 * 
	 * 
	 * @return boolean|Tekstove\Ban
	 */
	public static function autoBan() {

		$isUserBan = self::isUserBanned();

		$pdo = pdox::singleton();

		$banIp = self::isIpBanned();
		if ($banIp === false) {
			$banIp = self::isIpBannedExternalDataBase();
		}

		$isCookieBan = self::isCookieBan();



		$stm = $pdo->prepare('
			SELECT
				COUNT(`id`) AS `post_count`
			FROM
				`flood_control`
			WHERE
				`ip` = :ip
				AND `date` > SUBTIME(CURRENT_TIMESTAMP(),"0:0:30") 
			');

		$stm->bindValue(':ip', ip2long($_SERVER['REMOTE_ADDR']));
		$stm->execute();

		if ($stm->rowCount() > 0) {
			$post_count = $stm->fetch();
			$post_count = $post_count['post_count'];

			//chat::newMessage($post_count, 'spam detector');

			$banFlood = null;
			if ($post_count > 30) {
				$banFlood = new Tekstove\Ban();
				$banFlood->setDate(date('Y-m-d H:i:s', time() + 60 * 60)); // hour)
				$banFlood->comment = 'flood';
			}
		}


		$maxBan = new Tekstove\Ban();
		$maxBan->setDate(0);
		if ($banFlood && $banFlood->getDateTime() > $maxBan->getDateTime()) {
			$maxBan = $banFlood;
		}

		if ($banIp && $banIp->getDateTime() > $maxBan->getDateTime()) {
			$maxBan = $banIp;
		}
		if ($isCookieBan && $isCookieBan->getDateTime() > $maxBan->getDateTime()) {
			$maxBan = $isCookieBan;
		}
		if ($isUserBan && $isUserBan->getDateTime() > $maxBan->getDateTime()) {
			$maxBan = $isUserBan;
		}

		if (strtotime($maxBan->getDateTime()) > time()) {
			if (isset($_SESSION['id'])) {
				self::banUser($_SESSION['id'], $maxBan->getDateTime());
			}
			self::newBanIP($_SERVER['REMOTE_ADDR'], (int) ((strtotime($maxBan->getDateTime()) - strtotime('now')) / 60), null, $maxBan->getComment());
			self::newBanCookie($maxBan->getDateTime());
			$_SESSION['banned'] = $maxBan->getDateTime();
			return $maxBan;
		} else {
			return false;
		}
	}

}