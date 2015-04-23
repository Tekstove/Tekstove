<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */
Require ("__top.php");


if (!isset ($_REQUEST['id'])) {
    greshka('Не е посочена песен');
}
$id = (integer) $_REQUEST['id'];
potrebitel::zadaljitelno_lognat($username_id);



if (isset ($_POST['comment']) && mb_strlen($_POST['comment'])>5) {
    

	$stm = $pdo->prepare("INSERT INTO `comments` (`text`,  `sendby`, `zakoqpesen`, `date_orig`)
	VALUES (                                         ?,       ?,          ?,    CURRENT_TIMESTAMP)");
        $stm->bindValue(1, $_POST['comment'], PDO::PARAM_STR);
        $stm->bindValue(2, $_SESSION['id'], PDO::PARAM_INT);
        $stm->bindValue(3, $id, PDO::PARAM_INT);
        $stm->execute();
        
        
        potrebitel::addActivityPoints($_SESSION['id'], 5);

            echo "<br>Коментарът добавен успешно<br>";
            $stm = $pdo->prepare("UPDATE `lyric` SET `populqrnost` = ( `populqrnost` + 15) WHERE `id`= ? LIMIT 1");
            $stm->bindValue(1, $id, PDO::PARAM_INT);
            echo '<a href="browse.php?id='.$id.'">кликнете тук,ако не бъдете пренасочени</а>
            <META HTTP-EQUIV="refresh" content="0;URL=browse.php?id='.$id.'">';
            die();


     
} else {

    $pesen = new lyric($id);
    $stm = $pdo->prepare("SELECT * FROM `comments` WHERE `zakoqpesen` = ? ORDER BY `id` DESC LIMIT 5");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->execute();
    $komentari = $stm->fetchAll();

    foreach ($komentari as &$v) {
        $v['sendby_ime'] = potrebitel::ime_ot_id($v['sendby']);
    }
    unset($v);
            
}


require (SITE_PATH_TEMPLATE . 'komentar_nov.php');