<?php
Require ("__top.php");

$bez_reklami = true;

if (isset($_REQUEST['id'])) {
	$id = (int) $_REQUEST['id'];
} else {
	greshka('ne e poso4eno id', 'Не е посочено ИД');
}

potrebitel::zadaljitelno_lognat($username_id);

$pesen = new lyric($id);



if ($pesen->getText_bg()) {
	greshka('pesenta si ima prevod', "<b>{$pesen->get_Zaglavie_sakrateno()}</b> си има превод");
}



if (isset($_POST['prevod']) && $_POST['prevod']) {

	$stm = $pdo->prepare("INSERT INTO `edit_add_prevod` (`text`, `ot`, `za_pesen`, `ip`, `za_user_id`)
					VALUES (? , ? , ? , ? , ?	)");
	$stm->bindValue(1, $_POST['prevod'], PDO::PARAM_STR);
	$stm->bindValue(2, $username_id, PDO::PARAM_STR);
	$stm->bindValue(3, $id, PDO::PARAM_INT);
	$stm->bindValue(4, $_SERVER['REMOTE_ADDR'], PDO::PARAM_INT);
	$stm->bindValue(5, $pesen->getUp_id(), PDO::PARAM_INT);
	$stm->execute();


	$stm = $pdo->prepare('INSERT INTO `prevodi` (`user_id`, `text`, `zaglavie`)
            VALUES ( :user_id, :text, :zaglavie ) ');
	$stm->bindValue(':user_id', $username_id, PDO::PARAM_INT);
	$stm->bindValue(':text', $_POST['prevod'], PDO::PARAM_STR);
	$stm->bindValue(':zaglavie', $pesen->get_Zaglavie_sakrateno(1), PDO::PARAM_STR);
	$stm->execute();

	$stm = $pdo->prepare('UPDATE `users` SET `prevodi` = (`prevodi` + 1) WHERE `id` = ? ');
	$stm->bindValue(1, $username_id, PDO::PARAM_INT);
	$stm->execute();





	greshka(NULL, '<br>Преводът добавен успешно<br>Одобрението обикновено става до няколко дни');
} else {

	Require(SITE_PATH_TEMPLATE . '__top.php');
	?>
	<table><tr><td Valign="top">
				<textarea class="textarea_resizable" name="prevod" rows=25 cols=55 READONLY><?php echo $pesen->getText(true, false) ?> </textarea>
			</td><td Valign="top">
				<form action="" method="post" name="addcomment">
					<textarea class="textarea_sync_resize" name="prevod" rows=25 cols=55></textarea>
					<br>
					<input type="submit" name="subjoin" value="Добави превода">
				</form>
			</td></tr></table>

	<?php
	Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
}
  
						

