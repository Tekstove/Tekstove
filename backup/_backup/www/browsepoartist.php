<?php

Require("__top.php");

//Начало ако има  ID от GET
if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	try {
		$artist = new Tekstove\Artist\Artist($id);
	} catch (Tekstove\Artist\ArtistException $e) {
		
		switch ($e->getCode()) {
			case 301:
				headerHeler::pernamentRedirect('/browsepoartist.php?id='.$e->getMessage());
				break;
			case 410:
				greshka(null, 'няма намерен изпълнител', 410, false);
			case 404:
				greshka(null, 'няма намерен изпълнител', 404, false);
			default :
				throw $e;
				break;
		}
	}
} else {
	greshka('Нямаме изпълнител такъв номер');
}


$meta_title = "{$artist->getName()} - текстове, преводи и албуми";

//Ако Изпълнителя има албуми ги извеждаме
$stm = $pdo->prepare("SELECT `id`, `name`, `year`, `image` FROM `albums` WHERE `artist1id`= :id OR `artist2id`= :id ORDER BY `year`");
$stm->bindParam(':id', $id, PDO::PARAM_INT);
$stm->execute();
if ($stm->rowCount()) {

	$albumi = $stm->fetchAll();
}
//Краи Албуми


$stm = $pdo->prepare("SELECT `id`, `title`, `text_bg` FROM `lyric`
						WHERE	`artist1` = :id
						OR	`artist2` = :id
						OR	`artist3` = :id
						OR	`artist4` = :id
						OR	`artist5` = :id
						OR	`artist6` = :id
						ORDER BY LOWER(`title`)
							 ");
$stm->bindValue(':id', $id, PDO::PARAM_INT);
$stm->execute();

$pesni = $stm->fetchAll();


Require (SITE_PATH_TEMPLATE . "browsepoartist.php");
