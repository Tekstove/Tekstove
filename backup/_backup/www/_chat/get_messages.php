<?php

header("Content-type: application/json");
//header("Content-type: text/plain");
//header("Content-Type: text/xml;charset=utf-8");

define('site_do_not_load_templete', TRUE);

require '__functions.php';

//echo '{'; // json start

try {

	if (isset($_GET['start'])) {
		$start = (int) $_GET['start'];
	} else {
		$start = 0;
	}

	if ($start > 0) {
		
		if ($_GET['lastEdit'] > 0) {
			$sqlWhereLastEdit = "
				UNIX_TIMESTAMP(lastEdit) > :lastEditDate
			";
		} else {
			$sqlWhereLastEdit = " 0 ";
		}

		
		$stm = PDOX::singleton()->prepare("
					SELECT
						`chat`.*,
						`users`.*,
						`chat`.`id` AS `chat_id`
                    FROM
						`chat`
                    LEFT JOIN
						`users` ON `users`.`id` = `chat`.`username_id`
                    WHERE
						(
							`chat`.`id` > :id
							OR (
								{$sqlWhereLastEdit}
								/* performance boost */
								AND `chat`.`id` > (:id - 20)
							)
						)
					ORDER BY
						`chat`.`id`
					LIMIT
						20

				");
		$stm->bindValue(':id', $start, PDO::PARAM_INT);
		if ($_GET['lastEdit'] > 0) {
			$stm->bindValue(':lastEditDate', $_GET['lastEdit'], PDO::PARAM_INT);
		}
		
	} else {
		$stm = $pdo->prepare("
				SELECT
					`chat`.*,
                    `users`.*,
					`chat`.`id` AS `chat_id`
                FROM
					`chat`
				LEFT JOIN
						`users` ON `users`.`id` = `chat`.`username_id`
                WHERE
					(
						`chat`.`id` >
										(SELECT MAX(`id`) FROM `chat`) - 20
                    )
                 ORDER BY
					`chat`.`id`
				");
	}


	$stm->execute();

	if ($stm->rowCount() > 0) {

		$messages = $stm->fetchAll();

		foreach ($messages as $v) {
			if (currentUser::isLogged() != true || currentUser::getInstance()->getClass() < 100 ) {
				$v['ip'] = '';
			}
			$userTemp = new potrebitel($v);
			
			if ($v['lastEdit']) {
				$lastEdit = strtotime($v['lastEdit']);
			} else {
				$lastEdit = strtotime($v['date']);
			}
			
			$messages_json[] = array(
			    'id' => $v['chat_id'],
			    'message' => htmlspecialcharsX($v['message']),
				'allowBan' => $v['allowBan'],
			    'username_id' => $v['username_id'],
			    'username_avatar' => $userTemp->getAvatar(),
			    'username_name' => htmlspecialcharsX($v['username_name']),
			    'username_mood' => htmlspecialcharsX($v['username_mood']),
			    'date' => $v['date'],
			    'ip' => htmlspecialcharsX($v['ip']),
                            'classAsName' => $v['username_id'] ? $userTemp->getRankAsText() : '',
                            'editTimestamp' => strtotime($v['lastEdit']),
			);
		}

		echo json_encode($messages_json);
	}
} catch (Exception $e) {
	greshka($e);
}