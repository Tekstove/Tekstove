<?php

require __DIR__ . '/../__top.php';
try {
	$user = currentUser::getInstance();
	if ($user->getClass() < 100) {
		greshka('access denied');
	}

	$lyricFromId = $_POST['lyricFrom'];
	$lyricTo = $_POST['lyricTo'];

	$stm = $pdo->prepare('
	INSERT INTO
		`lyric_redirect` (`deleted_id`, `redirect_id`)
		VALUES(:from, :to)
		');
	$stm->bindValue('from', $lyricFromId, PDO::PARAM_INT);
	$stm->bindValue('to', $lyricTo, PDO::PARAM_INT);
	$stm->execute();

	echo json_encode(array(
		'status' => '1'
	));
} catch (Exception $e) {
	error_log($e);
	echo json_encode(array(
		'status' => '0'
	));
}