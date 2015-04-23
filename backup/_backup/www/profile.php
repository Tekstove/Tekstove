<?php

Require("__top.php");


if (isset($_GET['profile'])) {
	$id = (int) $_GET['profile'];
} else {
	greshka('Не е посочено ИД за профил', 'Не е посочен номер на профила');
}

$stm = $pdo->prepare("SELECT * FROM `users` WHERE `id` = ? LIMIT 1");
$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->execute();

if ($stm->rowCount() == 0) {
	greshka("Не намирам профил с номер $id", "Не намирам профил с номер $id");
}

$profile = new potrebitel($stm->fetch());


if ($profile->getPozdrav()) {

	$stm = $pdo->prepare("SELECT `id`, `zaglavie_sakrateno` FROM `lyric` WHERE `id` = ? LIMIT 1");
	$stm->bindValue(1, $profile->getPozdrav(), PDO::PARAM_INT);
	$stm->execute();

	$stm_data = $stm->fetch();
	$pozdrav['id'] = $stm_data['id'];
	$pozdrav['title'] = htmlspecialchars($stm_data['zaglavie_sakrateno']);

	lyric::proveri_imq_li_pesen($profile->getPozdrav(), $profile->getId());
}

$stm = $pdo->prepare('
    ( SELECT COUNT(`id`) AS `broi` FROM `glasuvane` WHERE `ot` = :id )
    UNION ALL
    ( SELECT COUNT(`id`) AS `broi` FROM `comments` WHERE `sendby` = :id )
    UNION ALL
    ( SELECT COUNT(`id`) AS `broi` FROM `forum_posts` WHERE `poster` = :id )
    ');

$stm->bindValue(':id', $id, PDO::PARAM_INT);
$stm->execute();




$data = $stm->fetch();
$statistic['broi_glasove'] = $data['broi'];

$data = $stm->fetch();
$statistic['broi_komentari'] = $data['broi'];

$data = $stm->fetch();
$statistic['broi_postove'] = $data['broi'];

$groupsStm = $pdo->prepare("
	SELECT
		permission_groups.id, permission_groups.name, permission_groups.image
	FROM
		permission_group_users
	INNER JOIN
		permission_groups
		ON permission_groups.id = permission_group_users.groupId
	WHERE
		`permission_group_users`.userId = :userId
");

$groupsStm->bindValue('userId', $id);

$groupsStm->execute();

$groupData = $groupsStm->fetchAll();

$groups = array();
foreach ($groupData as $groupData) {
	$groups[] = new Tekstove\Acl\Group($groupData);
}

unset($data);



Require (SITE_PATH_TEMPLATE . 'profile.php');