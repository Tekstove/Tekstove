<?php

require __DIR__ . '/../../../__top.php';

unset($_SESSION['tekstoveSessionKey']);

if (
	false === currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN_ROUGH_MESSAGES)
	&& false == currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN)
) {
	greshka('достъпът отказан');
}

if (isset($_POST['banMinutes'])) {
	$minutes = (int) $_POST['banMinutes'];

	$minutesMax = currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN);

	if ($minutes > $minutesMax && $minutes > currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN_ROUGH_MESSAGES))
		die('Не можеш за толкова дълго да банваш');

	if ($minutes < 1)
		die('0 не може');

} else {
	die('въведи за колко минути ще баннше де :)');
}


if (isset($_POST['msgId'])) {
    $msgID = (int) $_POST['msgId'];
} else {
    die('не е посочено ИД');
}

if ($msgID === 0) {
	die('не е посочено ИД');
}


$stm = $pdo->prepare('SELECT * FROM `chat` WHERE `id` = ? LIMIT 1');
$stm->bindValue(1, $msgID, PDO::PARAM_INT);
$stm->execute();

if ($stm->rowCount() == 0) {
	die('не намирам съобщението');
}

$msgData = $stm->fetch();

if (false == currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN)) {
	if ($msgData['allowBan'] == 0) {
		// @TODO ERROR LOG
		die('съобщението не позволява бан');
	}
}

$pdo->beginTransaction();

$ban_status = chat_ban::newBanFromMessageID($msgID, $minutes, currentUser::getInstance()->getUsername());

$pdo->commit();

die(chat_ban::getBanMessageFromStatus($ban_status));
