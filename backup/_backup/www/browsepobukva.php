<?php
Require("__top.php");
use Tekstove\Artist\Artist as Artist;

try {

if (isset ($_GET['page'])) {
	$page=((int)$_GET['page']);
}
else {
	$page = 0;
}

if (isset($_GET['artistbrowsebukva'])) {
	$bukva = (string) $_GET['artistbrowsebukva'];
	if (mb_strlen($bukva) > 2) {
		greshka('browse po bukva len > 2');
	}
	headerHeler::pernamentRedirect('/browsepobukva.php?bukva=' . $bukva);
}

if (!isset ($_GET['bukva'])) {
	greshka(NULL, 'не е посочена буква', 400);
}

$bukva = $_GET['bukva'];

if ((preg_match('#^[a-zA-Z0-9а-яА-Я]#', $bukva)) && ($bukva!=10)&&($bukva!=11)) {
			$stm = $pdo->prepare ("
				SELECT
					`id`, `name`
				FROM
					`artists`
				WHERE
					LOWER(`name`) LIKE LOWER( :bukva )
					AND " . Artist::getSqlOnlyActive() . "
				ORDER BY
					`name`
				LIMIT
					:stranica , 61
			");
			$stm->bindValue(':bukva', $bukva.'%', PDO::PARAM_STR);

			$stm_count = $pdo->prepare ("
				SELECT
					COUNT(`id`)
				FROM
					`artists`
				WHERE
					LOWER(`name`) LIKE LOWER( :bukva )
					AND " . Artist::getSqlOnlyActive() . "
				");
			$stm_count ->bindValue(':bukva', $bukva.'%', PDO::PARAM_STR);


                        }
		else if($bukva==10){
				$stm = $pdo->prepare("
					SELECT
						`id`, `name`
					FROM
						`artists`
					WHERE
						`name` LIKE ('0%')
						AND " . Artist::getSqlOnlyActive() . "
					ORDER BY
						`name`
					LIMIT
						:stranica , 61");
                                $stm_count = $pdo->prepare("SELECT COUNT(`id`) FROM `artists` WHERE `name` LIKE ('0%') ");
				}
		else if($bukva==11){
			$stm = $pdo->prepare("
					SELECT
						`id`, `name`
					FROM
						`artists`
					WHERE
						`name`NOT REGEXP \"^[0-9a-zA-Zа-яА-Я]\"
						AND " . Artist::getSqlOnlyActive() . "
					ORDER BY
						`name`
					LIMIT
						:stranica , 61
					");
			$stm_count = $pdo->prepare("
				SELECT
					COUNT(`id`)
				FROM
					`artists`
				WHERE
					`name` NOT REGEXP \"^[0-9a-zA-Zа-яА-Я]\"
					AND " . Artist::getSqlOnlyActive() . "
			");
			}
		else { greshka(NULL,"Няма изпълнители с започващи с тази буква");}

$stm->bindValue(':stranica', $page*60, PDO::PARAM_INT);
$stm->execute();

$stm_count -> execute();
$pagination_count = $stm_count->fetch();
$pagination_count = $pagination_count[0];


$izpalniteli = $stm->fetchAll();

}
catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "browsepobukva.php");
