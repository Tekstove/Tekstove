<?php

namespace Tekstove;

use Tekstove\Chat\Exception;

/**
 * Description of chat
 *
 * @author po_taka

 */
class Chat {

	/**
	 * 
	 * @param string $text
	 * @param string $mood
	 * @throws Exception
	 * @return true new message added
	 * @return false message eddited
	 */
	public function newMessage($text, $mood = '') {
		$pdo = \PDOX::singleton();
		
		$text = trim($text);
		
		if ($text == '') {
			throw new Exception('empty message', Exception::EMPTY_MESSAGE);
		}
		
		if (\currentUser::isLogged()) {
			$user = \currentUser::getInstance();
			$userName = $user->getUsername(false);
			$userAvatar = $user->getAvatar(false);
			$userId = $user->getId();
			
		} else {
			$userName = 'Гост_' . ip2long($_SERVER['REMOTE_ADDR']);
			$userAvatar = '';
			$userId = null;
		}
		
		$allowBan = false;
		if ($this->cenzorCheck($text)) {
			$text = 'Хора, благодаря Ви, че ме търпите :) ';
			$allowBan = true;
		} else {
			if ($this->cenzorSuspicousCheck($text)) {
				$allowBan = true;
			}
		}
		
		
		$matches = array();
		if (preg_match('|^\s*(?:http://)?tekstove\.info/browse\.php\?id=([0-9]+)#?[^ ]*\s*$|im', $text, $matches)) {
			try {
				$chatLyric = new \lyric((int) $matches[1], true);
				$text = "[url=http://tekstove.info/browse.php?id={$chatLyric->getId()}]{$chatLyric->get_Zaglavie_sakrateno(true)}[/url]";
				if ($chatLyric->getVideo_youtube()) {
					$text .= "\n[youtube]http://www.youtube.com/watch?v={$chatLyric->getVideo_youtube()}[/youtube]";
				}
			} catch (\Tekstove\LyricException $e) {
				zapis('chat lyric error' . PHP_EOL . $e);
			}
		}
		
		$appendLastMsg = true;
		
		if (preg_match('/^!/', $text)) {
			$appendLastMsg = false;
		}
		
		if ($appendLastMsg) { 
		
			if ($userId == null) {
				$appendLastMsg = FALSE;
			} else {
				$stmLastChatMsg = $pdo->prepare('
					SELECT
						*
					FROM
						`chat`
					ORDER BY
						id DESC
					LIMIT
						1
				');

				$lastChatMsgData = $stmLastChatMsg->execute();
				$lastChatMsgData = $stmLastChatMsg->fetch();
				
				if (!$lastChatMsgData['username_id'] || $lastChatMsgData['username_id'] != $user->getId()) {
					$appendLastMsg = false;
				}
			}
			
		}
		
		if ($appendLastMsg) {

			$return = false;
			$stmUpdateMsgInteadOfNew = $pdo->prepare("
				UPDATE
					`chat`
				SET
					`message` = CONCAT(`message`, '\n', :msg),
					`lastEdit` = CURRENT_TIMESTAMP(),
					allowBan = IF(allowBan = 1, 1, :allowBan)
				WHERE
					`id` = :id
			");

			$stmUpdateMsgInteadOfNew->bindValue(':id', $lastChatMsgData['id'], \PDO::PARAM_INT);
			$stmUpdateMsgInteadOfNew->bindValue(':msg', $text);
			$stmUpdateMsgInteadOfNew->bindValue(':allowBan', $allowBan, \PDO::PARAM_BOOL);
			$stmUpdateMsgInteadOfNew->execute();
		} else {
			$return = true;
			self::newMessageStatic($text, array(
											'username' => $userName,
											'userId'   => $userId,
											'userMood' => $mood,
											'allowBan' => $allowBan,
											)
				);
		}
		
		
		$searchMessage = '';
		if (preg_match('/^!seen /iu', $text)) {
			$searchUsername = mb_strcut($text, 6);

			$searchMessage = 'Търсене за "[b]' . $searchUsername . '[/b]" ...';

			$searchMessage .= PHP_EOL;

			$stmSearch = $pdo->prepare('
			SELECT
				*
			FROM
				`chat`
			WHERE
				`username_name` = :username
			ORDER BY
				`id` DESC
			LIMIT
				1
		');
			$stmSearch->bindValue(':username', $searchUsername);
			$stmSearch->execute();

			if ($stmSearch->rowCount() > 0) {
				$stmSearchData = $stmSearch->fetch();
				$searchMessage .= 'последно писа на ' . $stmSearchData['date']
						. PHP_EOL . PHP_EOL . '[quote]' . $stmSearchData['message'] . '[/quote]';
			} else {
				$searchMessage .= 'Не намирам потребителя';
			}
		} elseif (mb_strtolower($text) === '!statsme') {

			if (!$userId) {
				$searchMessage = 'А, да бе, и за гостите ли да броя';
			} else {
                $messageCount = $this->getUserPostsCount($user->getId());
				$searchMessage = '[b]' . $user->getUsername(false) . '[/b] е пратил/а ' . $messageCount . ' съобщения';

				$stmSearch = $pdo->prepare('SELECT * FROM `chat` WHERE `username_id` = :userID ORDER BY `id` LIMIT 1');
				$stmSearch->bindValue(':userID', $user->getId(), \PDO::PARAM_INT);
				$stmSearch->execute();

				$stmSearchData = $stmSearch->fetch();
				$searchMessage .= PHP_EOL . ' доколкото помня първото е на  ' . $stmSearchData['date'];
			}
		} elseif (preg_match('/^!stats /i', $text)) {
			$userTempName = mb_strcut($text, 7);
			$userTemp = trim($userTempName);
			$userTemp = \potrebitel::idFromName($userTemp);

			if ($userTemp === false) {
				$searchMessage = 'Не намирам [b]' . $userTempName . '[/b]';
			} else {

                $messageCount = $this->getUserPostsCount($userTemp);
				$searchMessage = '[b]' . $userTempName . '[/b] е пратил/а ' . $messageCount . ' съобщения';

				$stmSearch = $pdo->prepare('
				SELECT
					*
				FROM
					`chat`
				WHERE
					`username_id` = :userID
				ORDER BY
					`id`
				LIMIT
					1
			');
				$stmSearch->bindValue(':userID', $userTemp, \PDO::PARAM_INT);
				$stmSearch->execute();

				$stmSearchData = $stmSearch->fetch();
				$searchMessage .= PHP_EOL . ' доколкото помня първото е на  ' . $stmSearchData['date'];
			}
		} elseif (preg_match('/^!seens /iu', $text)) {
			$searchUsername = mb_strcut($text, 7);

			$searchMessage = 'Търсене за "[b]' . $searchUsername . '[/b]" ...';

			$searchMessage .= PHP_EOL;

			$stmSearch = $pdo->prepare('SELECT * FROM `chat` WHERE `username_name` LIKE (:username) ORDER BY `id` DESC LIMIT 1');
			$stmSearch->bindValue(':username', $searchUsername);
			$stmSearch->execute();

			if ($stmSearch->rowCount() > 0) {
				$stmSearchData = $stmSearch->fetch();
				$searchMessage = $stmSearchData['username_name'] . ' последно писа на ' . $stmSearchData['date']
						. PHP_EOL . PHP_EOL . '[quote]' . $stmSearchData['message'] . '[/quote]';
			} else {
				$searchMessage .= 'Не намирам потребителя';
			}
		} elseif (mb_strtolower($text) === '!help') {
			$searchMessage = '[b]!help[/b] - помощна информация'
					. PHP_EOL . '[b]!seen <username>[/b], например [b]!seen testt[/b]'
					. PHP_EOL . '[b]!statsme[/b] - статистка за профила ти'
					. PHP_EOL . '[b]!seens[/b]  въведи !help seens за повече информация'
					. PHP_EOL . '[b]!today[/b] показва известно събитие, случило се днес'
			;
		} elseif (mb_strtolower($text) === '!help seens') {
			$searchMessage = 'Подобно на [b]!seen[/b], като може да използвате '
					. PHP_EOL . '[b]%[/b] за съвпадение с който и да е символ колкото и да е пъти'
					. PHP_EOL . ' [b]_[/b] съвпадение с който и да е символ точно един път';
		} elseif (mb_strtolower($text) === '!today') {
			$todayData = \today::getTodayOne();
			if ($todayData == false) {
				$searchMessage = 'Днес не знам какво е станало';
			} else {
				$searchMessage = \today::getTodayOneHtml(true);
			}
		} elseif (preg_match('/^!censore /iu', $text) && \currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::CHAT_CENSORE)) {
			$userNameForCenzor = mb_strcut($text, 9);
            $searchMessage = "търсене за '{$userNameForCenzor}'";
            
            $stm = $pdo->prepare("
                UPDATE
                    `chat`
                SET
                    `message` = '[censored]',
                    `lastEdit` = CURRENT_TIMESTAMP()
                WHERE
                    `username_name` = :username
                ORDER BY
                    id DESC
                LIMIT
                    1
            ");
            
            $stm->bindValue('username', $userNameForCenzor);
            $stm->execute();
            
            if ($stm->rowCount() === 1) {
                $searchMessage = 'цензурирано съобщение';
            } else {
                $searchMessage = 'не намирам съобщение/потребител';
            }
            
		}

		if ($searchMessage) {
			self::newMessageSystemStatic($searchMessage);
		}
	}

	public static function newMessageSystemStatic($message, $from = SITE_NAME) {
		self::newMessageStatic($message, array(
			'username' => $from,
			'ip' => '',
		));
	}
	
	/**
	 * param, default
	 * @param $text
	 * @param $userName
	 * @param $userId NULL
	 * @param $userMood NULL
	 *
	 * @static
	 *
	 */
	public static function newMessageStatic($text, $options) {

		$userName = $options['username'];
		if (!array_key_exists('userId', $options) || $options['userId'] === NULL) {
			$userID = null;
		} else {
			$userID = (int)$options['userId'];
		}
		
		if (!array_key_exists('userMood', $options)) {
			$userMood = null;
		} else {
			$userMood = (string)$options['userMood'];
		}
		
		if (array_key_exists('allowBan', $options)) {
			$allowBan = $options['allowBan'];
		} else {
			$allowBan = false;
		}
		
		$pdo = \PDOX::singleton();

		$stm = $pdo->prepare('
			INSERT INTO `chat` (`message`, `username_id`, `username_name`, `username_mood`, `ip`, `allowBan`)
			VALUES(:message, :userID, :userName, :userMood, :ip, :allowBan) ');

		$stm->bindValue(':message', $text);

		if ($userID === NULL) {
			$stm->bindValue(':userID', NULL, \PDO::PARAM_NULL);
		} else {
			$stm->bindValue(':userID', $userID, \PDO::PARAM_INT);
		}

		if ($userMood === NULL) {
			$stm->bindValue(':userMood', NULL, \PDO::PARAM_NULL);
		} else {
			$stm->bindValue(':userMood', $userMood);
		}

		$stm->bindValue(':userName', $userName, \PDO::PARAM_STR);
		if (array_key_exists('ip', $options)) {
			$ip = $options['ip'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$stm->bindValue(':ip', $ip);
		
		$stm->bindValue('allowBan', $allowBan, \PDO::PARAM_BOOL);
		
		$stm->execute();
	}

	public function spamCheck($text) {
		throw new \Exception('not implemented');
	}
	
	public function cenzorCheck($text) {
		return cenzor($text);
	}
	
	public function cenzorSuspicousCheck($text) {
		return cenzorSuspicious($text);
	}

    /**
     * 
     * @param int $userId
     */
    public function getUserPostsCount($userId) {
        $userId = (int)$userId;
        $pdo = \PDOX::singleton();
        $stm = $pdo->prepare("
            SELECT
                COUNT(id) AS `messageCount`
            FROM
                chat
            WHERE
                username_id = :userId
        ");
        $stm->bindValue('userId', $userId, \PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetch();
        $messageCount = $data['messageCount'];
        
        $stmArchivedMessages = $pdo->prepare("
            SELECT
                chatMessages
            FROM
                users
            WHERE
                id = :userId
        ");
        
        $stmArchivedMessages->bindValue('userId', $userId);
        $stmArchivedMessages->execute();
        if ($stm->rowCount() == 0) {
            throw new Exception('can\'t find user');
        }
        
        $userArchivedData = $stmArchivedMessages->fetch();
        
        $messageCount += $userArchivedData['chatMessages'];
        
        return $messageCount;
    }
    
    public function censore($messageId)
    {
        $pdo = \PDOX::singleton();
        
        $stm = $pdo->prepare("
            SELECT
                *
            FROM
                chat
            WHERE
                id = :id
        ");

        $stm->bindValue('id', $messageId);

        $stm->execute();

        if ($stm->rowCount() === 0) {
            throw new Exception('Message not found');
        }
        
        $messageData = $stm->fetch();
        
        $updateStm = $pdo->prepare("
            UPDATE
                chat
            SET
                message = '[censored]',
                lastEdit = CURRENT_TIMESTAMP()
            WHERE
                id = :id
        ");
        $updateStm->bindValue('id', $messageId);
        $updateStm->execute();
        
        return true;

    }

}
