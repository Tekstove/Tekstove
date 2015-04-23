<?php

Require('__top.php');


try {

	potrebitel::zadaljitelno_lognat($username_id);

	if (!isset($_GET['id'])) {
		greshka('без ид', 'Не намирам съобщение с такъв номер');
	}

	$id = (int) $_GET['id'];



	$stm = $pdo->prepare('SELECT * FROM `pm` WHERE `id` = ? LIMIT 1');
	$stm->bindValue(1, $id, PDO::PARAM_INT);
	$stm->execute();

	if ($stm->rowCount() == 0) {
		greshka('няма съобщения с това ид', 'не намирам съобщението');
	}


	$ls = $stm->fetch();

	if ($ls['za'] != $username_id && $username_id != $ls['ot']) {
		greshka('ne e za teb', 'Това съобщение не е за теб');
	}

	$ls['text'] = nl2br_my(htmlspecialchars($ls['text']));
	$ls['ot_ime'] = potrebitel::ime_ot_id($ls['ot']);
	$ls['otnosno_bezhtmlsp'] = $ls['otnosno'];
	$ls['otnosno'] = htmlspecialchars($ls['otnosno']);


	if ($ls['procheteno'] == 0 && $username_id == $ls['za']) {
		$stm = $pdo->prepare('UPDATE `pm` SET `procheteno` = 1 WHERE `id` = ? LIMIT 1');
		$stm->bindValue(1, $id, PDO::PARAM_INT);
		$stm->execute();
	}
	
	$stmConversationHistory = $pdo->prepare("
		SELECT
			*
		FROM
			`pm`
		INNER JOIN
			`users`
				ON
					users.id = ot
		WHERE
			(
				(`za` = :from AND `ot` = :to)
				OR
				(`za` = :to AND `ot` = :from)
			)
			AND pm.id < :id
		ORDER BY
			pm.`id` DESC
        LIMIT
            10
	");
	
	$stmConversationHistory->bindValue('id', $id);
	$stmConversationHistory->bindValue('to', $ls['za']);
	$stmConversationHistory->bindValue('from', $ls['ot']);
	$stmConversationHistory->execute();
	$conversationHistory = $stmConversationHistory->fetchAll();
	
	
} catch (Exception $e) {
	greshka($e);
}

require SITE_PATH_TEMPLATE . 'lichni_syobshteniq_vij.php';