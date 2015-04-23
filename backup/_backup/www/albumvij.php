<?php

Require("__top.php");

$title = "";
$echo_predi_top = "";

if (isset($_GET['id'])) {
	$id = (integer) $_GET['id'];
}

if (!$id) {
	greshka("Не намирам албум номер $id ");
}


$stm = $pdo->prepare("SELECT * FROM `albums` WHERE `id` = ? LIMIT 1");
$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->execute();

if ($stm->rowCount() == 0)
	greshka(NULL, "Не намирам албум с номер $id ");

$album = $stm->fetch();
if ($album['up_id'])
	$album['up_ime'] = potrebitel::ime_ot_id($album['up_id']);



if ((($username_id == $album['up_id']) && ($username)) || ($userclass >= 20))
	$album_sobstvenik = true;
else
	$album_sobstvenik = FALSE;


$pesen = array();
for ($q = 1; $q <= 35; $q++)
	if ($album['p' . $q]) {
		$stm = $pdo->prepare("SELECT `zaglavie_sakrateno`, `video_vbox7`, `video_youtube` FROM `lyric` WHERE `id` = ? LIMIT 1");
		$stm->bindValue(1, $album['p' . $q], PDO::PARAM_INT);
		$stm->execute();

		if ($stm->rowCount() == 0) {
			$pesen[] = array('id' => NULL,
				'zaglavie_sakrateno' => 'Не намерена песен',
				'video_vbox7' => NULL,
				'video_youtube' => NULL,
				'nomer' => $q
			);
		} else {
			$r = $stm->fetch();

			$pesen[] = array('id' => $album['p' . $q],
				'zaglavie_sakrateno' => htmlspecialcharsX($r['zaglavie_sakrateno']),
				'video_vbox7' => $r['video_vbox7'],
				'video_youtube' => $r['video_youtube'],
				'nomer' => $q
			);
		}
	} else if ($album['p' . $q . 'n'])
		$pesen[] = $q . ". " . htmlspecialcharsX($album['p' . $q . 'n']) . "</i>";



Require (SITE_PATH_TEMPLATE . "albumvij.php");
