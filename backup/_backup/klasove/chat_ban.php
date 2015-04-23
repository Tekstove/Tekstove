<?php

/**
 * Description of chat_ban
 *
 * @author po_taka
 *
 * throw exception on error
 *
 * return integer
 */
class chat_ban
{
	const BAN_ADDED = 1;
	const NO_ERRORS = 2;
	const MESSAGE_NOT_FOUND = 3;
	const ALREADY_BANNED = 4;
	const USER_LEVEL_TOO_HIGH = 5;

	public static function getBanMessageFromStatus($a)
	{

		switch ($a)
		{
			case 1: return 'ban added';
			case 3: return 'message not found';
			case 4: return 'already banned';
			case 5: return 'user level too high';

			default : greshka('gre6ka pri ban message from status');
		}
	}

	public static function newBanFromMessageID($msgID, $minutes, $moderatorName = '', $force = false)
	{
		// no need to check msgID, cuz query will return empty result if arguments are invalid, and ...
        $pdo = PDOX::singleton();

        $stm = $pdo->prepare('SELECT * FROM `chat` WHERE `id` = :id');
        $stm->bindValue(':id', $msgID, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() == 0) {
            return self::MESSAGE_NOT_FOUND;
        }

        $data = $stm->fetch();

        if ($data['ip'] == '') {
            return self::USER_LEVEL_TOO_HIGH;
        }

        $stmUpdateMessage = $pdo->prepare("
            UPDATE
                `chat`
            SET
                `message` = '[banned]',
                `lastEdit` = CURRENT_TIMESTAMP()
            WHERE
                `id` = :id
        ");
        $stmUpdateMessage->bindValue(':id', $msgID);
        $stmUpdateMessage->execute();


        // check if mod ban

        if ($data['username_id']) {
            $user = new potrebitel((int) $data['username_id']);
            if ($user->getClass() >= 20) {
                return self::USER_LEVEL_TOO_HIGH;
            }

            // ban user
            $stmUserBan = $pdo->prepare('UPDATE `users` SET `banned` = :banTime WHERE `id` = :id');
            $stmUserBan->bindValue(':id', $data['username_id'], PDO::PARAM_INT);
            $chatBanTimeTemp = strtotime('+' . $minutes . 'minute');
            $chatBanTimeTemp = date('Y-m-d H:i:s', $chatBanTimeTemp);

            $stmUserBan->bindValue(':banTime', $chatBanTimeTemp);
            $stmUserBan->execute();
        }


        $banComment = 'бан в чат:' . PHP_EOL . PHP_EOL . $data['message'];
        ban::newBanIP($data['ip'], $minutes, null, $banComment);



        $banMessage = 'Нов бан, ' . $data['username_name'] . ', ' . $minutes . ' минути' .
            PHP_EOL . 'добавен от ' . $moderatorName;
        
        Tekstove\Chat::newMessageSystemStatic($banMessage);

        return self::BAN_ADDED;

	}

}