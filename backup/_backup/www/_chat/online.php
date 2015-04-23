<?php

//header("Content-Type: text/xml;charset=utf-8");

require '../__top.php';
try {


	if ($username) {
		$chat_username_name = $_SESSION['usernameClean'];
	} else {
		$chat_username_name = 'Гост_' . ip2long($_SERVER['REMOTE_ADDR']);
	}



	if (currentUser::isLogged()) {
		$stm = $pdo->prepare('
			UPDATE
				`chat_online`
			SET
				`date` = CURRENT_TIMESTAMP
			WHERE
				`userId` = :userId ');
		$stm->bindValue('userId', currentUser::getInstance()->getId(), PDO::PARAM_INT);
	} else {
		$stm = $pdo->prepare('
			UPDATE
				`chat_online`
			SET
				`date` = CURRENT_TIMESTAMP
			WHERE
				`username` = :userName
				AND userId IS NULL
		');
		$stm->bindValue('userName', $chat_username_name);
	}
	
	$stm->execute();

	if ($stm->rowCount() === 0) {
		$stm = $pdo->prepare('
			INSERT
				INTO `chat_online`(`userId` ,`username`)
				VALUES(:userId, :userName)
		');
		$stm->bindValue('userName', $chat_username_name);
		
		if (currentUser::isLogged()) {
			$stm->bindValue('userId', currentUser::getInstance()->getId(), PDO::PARAM_INT);
		} else {
			$stm->bindValue('userId', null, PDO::PARAM_NULL);
		}
		$stm->execute();
	}


	// now get online users
	$stm = $pdo->prepare('
		SELECT
			`username`,
			`userId`
		FROM
			`chat_online`
		WHERE
			`date` > ?
		ORDER BY
			`username`
	');
	$date = new DateTime();
	$date->sub(DateInterval::createFromDateString('2 minutes'));

	$stm->bindValue(1, $date->format('Y-m-d H:i:s'));
	$stm->execute();

	if ($stm->rowCount() > 0) {
		$online = array();
		foreach ($stm->fetchAll() as $v) {
			$online[] = array(
				'username' => htmlspecialcharsX($v['username']),
				'id' => $v['userId'],
				);
		}

		echo json_encode($online);
	}
} catch (Exception $e) {


		greshka($e);

}