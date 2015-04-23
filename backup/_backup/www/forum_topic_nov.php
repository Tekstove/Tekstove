<?php
Require ("__top.php");


$bez_reklami = true;
potrebitel::zadaljitelno_lognat($username_id);

if (!isset($_GET['razdel'], $_REQUEST['razdel'])) {
    greshka("не намирам раздела на форума (1)");
}

$forum_razdel = (int) $_REQUEST['razdel'];

$stm = $pdo->prepare("SELECT `id`,`name`, hidden FROM `forum_razdel` WHERE `id` = ? ");
$stm->bindValue(1, $forum_razdel, PDO::PARAM_INT);
$stm->execute();
if ($stm->rowCount() == 0) {
    greshka("не намирам раздела на форума (2)");
}

$razdel = $stm->fetch();

$category = new Tekstove\Forum\Category($razdel);
if ($category->getHidden() > 0 && 
        (
            0 == currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)
        )
    ) {
    greshka('access denied', 'достъпът отказан');
}

$razdel['name'] = htmlspecialchars($razdel['name']);

if (isset ($_POST['title'], $_POST['post']) && $_POST['title'] && $_POST['post']) {

	$stm = $pdo->prepare("
        INSERT INTO `forum_topic` (`topic_starter`, `topic_name`, `topic_razdel`)
        VALUES (?, ?, ?)
    ");

    $stm->bindValue(1, currentUser::getInstance()->getId(), PDO::PARAM_INT);
    $stm->bindValue(2, $_POST['title'], PDO::PARAM_STR);
    $stm->bindValue(3, $razdel['id'], PDO::PARAM_INT);

    $stm->execute();

    $tema_id = $pdo->lastInsertId();

    echo "<br>Записът на тема Успешен";


	$stm = $pdo->prepare("INSERT INTO `forum_posts` (`post`, `poster`, `za_topic_id`)
	VALUES (?, ?, ?)");
	$stm->bindValue(1, $_POST['post'], PDO::PARAM_STR);
    $stm->bindValue(2, currentUser::getInstance()->getId(), PDO::PARAM_INT);
    $stm->bindValue(3, $tema_id, PDO::PARAM_INT);
    $stm->execute();

	$topic = new topic($tema_id);
	
	$topic->addWatcher($_SESSION['id']);
		
        echo "<br>Запис на мнение Успешен";

		
		?>
		<br>Пренасочване
		<META HTTP-EQUIV="refresh" content="0;URL=forum_topic_vij.php?id=<?php echo $tema_id;?>">
		<?php die();
			
}



require SITE_PATH_TEMPLATE . 'forum_topic_nov.php';
