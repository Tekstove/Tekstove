<?php
require '__functions.php';

$status_ok = '1';
$status_banned = '2';
$status_empty_message = '3';

if (isset($_REQUEST['text'])) {

	$chat = new \Tekstove\Chat();
	
	if (!isset($_REQUEST['hesh'])) {
		headerHeler::unauthorized();
		die;
	}

	$hesh = $_REQUEST['hesh'];
	if ($hesh != md5(session_id())) {
		headerHeler::unauthorized();
		die;
	}


	$forbiddenLinkInPost = spamCheck($_REQUEST['text']);
	if ($forbiddenLinkInPost) {
		ban::newBanIP($_SERVER['REMOTE_ADDR'], 180, NULL, $forbiddenLinkInPost . ' не е позволен за линкване');
		zapis('ban: ' . print_r($_REQUEST['text'], true));
		headerHeler::forbidden();
		die();
	}

	$chat_username_mood = $_REQUEST['user_mood'];

	try {
		$newMessage = $chat->newMessage($_REQUEST['text'], $chat_username_mood);
		if ($newMessage && currentUser::isLogged()) {
			potrebitel::addActivityPoints(currentUser::getInstance()->getId(), 1);
		}
	} catch (Tekstove\Chat\Exception $e) {
		if ($e->getCode() !== Tekstove\Chat\Exception::EMPTY_MESSAGE) {
			throw $e;
		}
	}
}

die($status_ok);