<?php
$title = "Редактиране на текст ";
Require("__top.php");

/* @var $pdo PDOX */

$errors = '';
try {
	potrebitel::zadaljitelno_lognat($username_id);

	$id = (int) $_REQUEST['id'];
	if (!$id) {
		greshka('lyric not found', 'не намирам песен с номер ' . $id);
	}


//=============          CHECK

	$stm = $pdo->prepare("SELECT * FROM `lyric_editprotect` WHERE    (
         `pesen_id` = ?     &&     (  (`vreme` + INTERVAL 10 MINUTE) > NOW()   )
                                    )  ");
	$stm->bindValue(1, $id, PDO::PARAM_INT);
	$stm->execute();

	$stm_data = $stm->fetch();

	if ($stm->rowCount() > 0) {
		if ($stm_data['user_id'] != $username_id) {
			greshka(NULL, 'в момента друг потребител обработва песента, опитай пак след 10 минути');
		}
	}

	if ($stm->rowCount() == 0) {
		$stm = $pdo->prepare("INSERT INTO `lyric_editprotect` (`pesen_id`, `user_id`) VALUES (? , ?) ");
		$stm->bindValue(1, $id, PDO::PARAM_INT);
		$stm->bindValue(2, $username_id, PDO::PARAM_INT);
		$stm->execute();
	} else {
		$stm = $pdo->prepare('UPDATE `lyric_editprotect` SET `vreme` = NOW() WHERE `id` = ? ');
		$stm->bindValue(1, $stm_data['id'], PDO::PARAM_INT);
		$stm->execute();
	}


	$pesen = new lyric($id);

	if (($username_id != $pesen->getUp_id()) && ($userclass < 20)) {
		greshka(NULL, "Достъпът отказан");
	}

	$pesen->cenzora18();

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (isset($_POST['delete'])) {

			if ((int) $_POST['deletekod'] != ( (int) strlen($pesen->getText(1, 1)) + (int) $pesen->getId() + (int) strlen($username))) {
				throw new Tekstove\LyricValidationException('грешен код');
			}

			if (empty($_POST['lyric_delete_reason'])) {
				throw new Tekstove\LyricValidationException('избери причина за изтриване');
			}
			switch ($_POST['lyric_delete_reason']) {
				case 1: // other
					if (!isset($_POST['lyric_edit_delete_other_reason'])) {
						throw new Tekstove\LyricException('lyric_edit_delete_other_reason not set');
					}

					$deleteReason = $_POST['lyric_edit_delete_other_reason'];
					if (empty($deleteReason)) {
						throw new Tekstove\LyricValidationException('въведи причина за изтриване');
					}

					break;
				case 2: // repeated
					if (!isset($_POST['lyric_existing_link'])) {
						throw new Tekstove\LyricException('lyric_existing_link not set');
					}

					if (empty($_POST['lyric_existing_link'])) {
						throw new Tekstove\LyricValidationException('въведи линк към първоизпратената песен');
					}

					$existingLink = (string) $_POST['lyric_existing_link'];
					preg_match('~browse\.php\?id=([0-9]+)~i', $existingLink, $matches);
					if (count($matches) != 2) {
						throw new Tekstove\LyricValidationException('линкът към песента трябва да е във формат <b>http://tekstove.info/browse.php?id=<u>????</u></b>');
					}
					$existingLyricId = $matches[1];
					if ($existingLyricId >= $pesen->getId()) {
						throw new Tekstove\LyricValidationException('текущата песен е пратена преди дадената за повтаряща. ' . $pesen->getId() . '<' . $existingLyricId);
					}
					try {
						$existingLyric = new lyric((int) $existingLyricId);
					} catch (Tekstove\LyricException $e) {
						/* @var $e ErrorException */
						if ($e->getCode() == 404) {
							throw new Tekstove\LyricValidationException('песента с която се повтаря не е намерене');
						}
						throw $e;
					}
					$deleteReason = 'повтаря се [url=http://tekstove.info/browse.php?id=' . $existingLyric->getId() . ']ttp://tekstove.info/browse.php?id=' . $existingLyric->getId() . '[/url]';
					break;

				default:
					throw new Tekstove\LyricException('reason not implemented' . $_POST['lyric_delete_reason']);
			}

			$pdo->beginTransaction();

			$stm = $pdo->prepare("
				INSERT INTO `lyric-iztriti` (`id_ztril`, `lyric_id`, `prichina`, `zaglavie_palno`, `zaglavie_sakrateno`, `up_id`, `text`, `text_bg`, `title`, `album1`, `album2`, `video`, `video_vbox7`, `video_youtube`, `video_metacafe`, `image`, `ip_upload`, `dopylnitelnoinfo`, `glasa`, `vidqna`, `populqrnost`)
					SELECT :id_iztril, id, :prichina, `zaglavie_palno`, `zaglavie_sakrateno`, `up_id`, `text`, `text_bg`, `title`, `album1`, `album2`, `video`, `video_vbox7`, `video_youtube`, `video_metacafe`, `image`, `ip_upload`, `dopylnitelnoinfo`, `glasa`, `vidqna`, `populqrnost` FROM `lyric` WHERE `id` = :id
			");
			$stm->bindValue(':id', $id, PDO::PARAM_INT);
			$stm->bindValue(':prichina', $deleteReason, PDO::PARAM_STR);
			$stm->bindValue(':id_iztril', $username_id, PDO::PARAM_INT);
			$stm->execute();

			$pesen_backup_id = $pdo->lastInsertId();

			$stm = $pdo->prepare('INSERT INTO `comments-iztriti` (`text`, `sendby`, `date`, `date_orig`, `edited`, `zakoqpesen`)
				SELECT                                            `text`, `sendby`, `date`, `date_orig`, `edited`, :pesen_backup_id FROM `comments` WHERE `zakoqpesen` = :pesen_id ORDER BY `id` ');
			$stm->bindValue(':pesen_id', $id, PDO::PARAM_INT);
			$stm->bindValue(':pesen_backup_id', $pesen_backup_id, PDO::PARAM_INT);
			$stm->execute();



			if ($pesen->getUp_id()) {
				$stm = $pdo->prepare('
					INSERT INTO `pm` ( `za`, `ot`, `text`, `otnosno`)
					VALUES ( :za, :iztril_pesenta_id , :text, :otnosno)');
				$stm->bindValue(':za', $pesen->getUp_id(), PDO::PARAM_INT);
				$stm->bindValue(':text', 'Песента [b]' . $pesen->get_Zaglavie_sakrateno(1) . '[/b] бе изтрита' . PHP_EOL . PHP_EOL . 'причина: ' . PHP_EOL . $deleteReason, PDO::PARAM_STR);
				$stm->bindValue(':otnosno', 'Изтрита песен', PDO::PARAM_STR);
				$stm->bindValue(':iztril_pesenta_id', $username_id, PDO::PARAM_INT);
				$stm->execute();
			}



			$stm = $pdo->prepare("DELETE FROM `lyric` WHERE `id` = ? ");
			$stm->bindValue(1, $id, PDO::PARAM_INT);
			$stm->execute();

			$pdo->commit();

			greshka(NULL, 'Песента изтрита');
		}
		$lyric_attr = array('artist1', 'artist2', 'artist3', 'artist4', 'artist5', 'artist6',
			'text', 'text_bg', 'title', 'album1', 'album2',
			'video', 'video_vbox7', 'video_youtube', 'video_metacafe',
			'image', 'dopylnitelnoinfo', 'pee_se_na');

		foreach ($lyric_attr as $v) {
			if (isset($_POST["$v"]))
				$pesen_edit["$v"] = $_POST["$v"];
			else
				$pesen_edit["$v"] = '';
		}
		$pesen_edit['video'] = strip_tags($pesen_edit['video']);
		$pesen_edit['video'] = htmlspecialcharsX($pesen_edit['video']);
		$pesen_edit['video_vbox7'] = lyric::videoc_vboxcode($pesen_edit['video_vbox7']);
		$pesen_edit['video_youtube'] = lyric::video_youtube($pesen_edit['video_youtube']);
		$pesen_edit['video_metacafe'] = lyric::videoc_metacafecode($pesen_edit['video_metacafe']);


		$S_janrove_poleta = NULL;
		foreach (lyric::janrove() as $k => $v) {
			if (isset($_POST["$k"]))
				$pesen_edit["$k"] = 1;
			else
				$pesen_edit["$k"] = '0';

			$S_janrove_poleta .= ', `' . $k . '` = ' . $pesen_edit["$k"];
		}

		foreach ($pesen_edit as &$v) {
			$v = trim($v);
		} unset($v);

		$pesen_edit['artist1_ime'] = lyric::artist_name_ot_id($pesen_edit['artist1'], TRUE);
		$pesen_edit['artist2_ime'] = lyric::artist_name_ot_id($pesen_edit['artist2'], TRUE);
		$pesen_edit['artist3_ime'] = lyric::artist_name_ot_id($pesen_edit['artist3'], TRUE);
		$pesen_edit['artist4_ime'] = lyric::artist_name_ot_id($pesen_edit['artist4'], TRUE);
		$pesen_edit['artist5_ime'] = lyric::artist_name_ot_id($pesen_edit['artist5'], TRUE);
		$pesen_edit['artist6_ime'] = lyric::artist_name_ot_id($pesen_edit['artist6'], TRUE);


		$Salbum = str_replace("http://www.tekstove.info/albumvij.php?id=", "", $pesen_edit['album1']);
		$Salbum = str_replace("http://tekstove.info/albumvij.php?id=", "", $Salbum);
		$Salbum = (integer) $Salbum;

		$Salbum2 = str_replace("http://www.tekstove.info/albumvij.php?id=", "", $pesen_edit['album2']);
		$Salbum2 = str_replace("http://tekstove.info/albumvij.php?id=", "", $Salbum2);
		$Salbum2 = (integer) $Salbum2;



		$Svideo_vbox7 = lyric::videoc_vboxcode($pesen_edit['video_vbox7']);
		$Svideo_youtube = str_replace("watch?v=", "v/", $pesen_edit['video_youtube']);
		$Svideo_metacafe = lyric::videoc_metacafecode($pesen_edit['video_metacafe']);


		$stm = $pdo->prepare("UPDATE `lyric` SET
        `text` = :text,
        `text_bg` = :text_bg,
        `artist1` = :artist1, `artist2` = :artist2, `artist3` = :artist3, `artist4` = :artist4, `artist5` = :artist5, `artist6` = :artist6,
        `title` = :title,
         `album1` = :album1, `album2` = :album2,
         `video` = :video, `video_vbox7` = :video_vbox7, `video_youtube` = :video_youtube, `video_metacafe` = :video_metacafe,
         `image` = :image, `ip_upload` = :ip_upload, `dopylnitelnoinfo` = :dopylnitelnoinfo, `pee_se_na` = :pee_se_na " . $S_janrove_poleta . "
         WHERE `id` = :id LIMIT 1
            ");

		$stm->bindValue(':text', $pesen_edit['text'], PDO::PARAM_STR);
		$stm->bindValue(':text_bg', $pesen_edit['text_bg'], PDO::PARAM_STR);

		$stm->bindValue(':artist1', $pesen_edit['artist1'], PDO::PARAM_INT);
		$stm->bindValue(':artist2', $pesen_edit['artist2'], PDO::PARAM_INT);
		$stm->bindValue(':artist3', $pesen_edit['artist3'], PDO::PARAM_INT);
		$stm->bindValue(':artist4', $pesen_edit['artist4'], PDO::PARAM_INT);
		$stm->bindValue(':artist5', $pesen_edit['artist5'], PDO::PARAM_INT);
		$stm->bindValue(':artist6', $pesen_edit['artist6'], PDO::PARAM_INT);
		$stm->bindValue(':title', $pesen_edit['title'], PDO::PARAM_STR);

		$stm->bindValue(':album1', $pesen_edit['album1'], PDO::PARAM_INT);
		$stm->bindValue(':album2', $pesen_edit['album2'], PDO::PARAM_INT);

		$stm->bindValue(':video', $pesen_edit['video'], PDO::PARAM_STR);
		$stm->bindValue(':video_vbox7', $Svideo_vbox7, PDO::PARAM_STR);
		$stm->bindValue(':video_youtube', $Svideo_youtube, PDO::PARAM_STR);
		$stm->bindValue(':video_metacafe', $Svideo_metacafe, PDO::PARAM_STR);

		$stm->bindValue(':image', $pesen_edit['image'], PDO::PARAM_STR);
		$stm->bindValue(':ip_upload', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
		$stm->bindValue(':dopylnitelnoinfo', $pesen_edit['dopylnitelnoinfo'], PDO::PARAM_STR);
		$stm->bindValue(':pee_se_na', $pesen_edit['pee_se_na'], PDO::PARAM_INT);

//    foreach (lyric::janrove() as $k => $v) {
//        if($pesen_edit["$k"]) $stm->bindValue(':'.$k, 1, PDO::PARAM_INT);
//        else $stm->bindValue(':'.$k, 0, PDO::PARAM_INT);
//
//    }

		$stm->bindValue(':id', $id, PDO::PARAM_INT);


		$stm->execute();

		$lyricUdated = new lyric((int)$id);
		$lyricUdated->updateCache();

        $contentChcker = \Tekstove\Registry::getInstance()->getContentCecker();
        if (false === $pesen->isCenzored() && (!empty($_POST['cenzora']) || false === $contentChcker->isSafe($pesen_edit['text']))) {
            try {
                $stmCenzore = $pdo->prepare("INSERT INTO `lyric_18` (`id`) VALUES ( :id )");
                $stmCenzore->bindValue(':id', $pesen->getId(), PDO::PARAM_INT);
                $stmCenzore->execute();
            } catch (PDOException $e) {
                zapis((string) $e);
            }
        } elseif (isset ($_POST['cenzora'])) {
            $stm = $pdo->prepare("DELETE FROM `lyric_18` WHERE `id` = ? ");
			$stm->bindValue(1, $pesen->getId(), PDO::PARAM_INT);
			$stm->execute();
        }

		if (isset($_POST['download'])) {
			$download = $_POST['download'];
			$download = trim($download);

			if ($userclass < 100) {
				greshka('user class do not allow download link');
			}

			$stm = $pdo->prepare("UPDATE `lyric` SET `download` = :download WHERE `id` = :id");
			$stm->bindValue(':id', $id, PDO::PARAM_INT);
			if ($download) {
				$stm->bindValue(':download', $download);
			} else {
				$stm->bindValue(':download', null, PDO::PARAM_NULL);
			}

			$stm->execute();
		}
		?>Готово...пренасочване<META HTTP-EQUIV="refresh" content="0;URL=browse.php?id=<?php echo $id; ?>">
		<?php
		die();
	} // POST
	else {


// извличаме от БД записите, за да се кешират и да не се изведе грешка
		$pesen->getStil();
		$pesen->cenzora18();
		$pesen->getArtist1_ime(1);
		$pesen->getArtist2_ime(1);
		$pesen->getArtist3_ime(1);
		$pesen->getArtist4_ime(1);
		$pesen->getArtist5_ime(1);
		$pesen->getArtist6_ime(1);
	}
} catch (Tekstove\LyricValidationException $e) {
	/* @var $e ErrorException */
	$errors = $e->getMessage();
} catch (Exception $e) {
	greshka($e);
}


Require (SITE_PATH_TEMPLATE . 'uploadlirycedit.php');
