<?php
Require("__top.php");

$bez_reklami = true;
if ($username_id==90) {
    greshka('Тестовият профил няма права за промяна');
}

if ($username_id==90) {
    greshka(NULL, 'Тестовият профил няма право да изпраща албум');
}

potrebitel::zadaljitelno_lognat($username_id);

if (!isset ($_GET['id']) && $_GET['id']) {
    greshka('не намирам коментар с този номер');
}

$id = (int)$_GET['id'];

$stm = $pdo->prepare("SELECT * FROM `comments` WHERE `id` = ? LIMIT 1");
$stm -> bindValue(1, $id, PDO::PARAM_INT);
$stm -> execute();
$komentar = $stm->fetch();

if (($username_id != $komentar['sendby']) && ($userclass<20)) {
    greshka('accesdenied/достъпът отказан 38');
}

if (isset($_POST['submit'])) {
	if (isset ($_POST['delete']) && $_POST['delete']==='delete' ) {

			$stm = $pdo->prepare ("DELETE FROM `comments` WHERE `id` = ? ");
			$stm -> bindValue(1, $id, PDO::PARAM_INT);
                        $stm -> execute();
			?>Deleting....done...redirecting
                        <META HTTP-EQUIV="refresh" content="1;URL=browse.php?id=<?php echo $komentar['zakoqpesen']; ?>">
                        <?php
                        die();
	} else {
        $stm = $pdo->prepare("UPDATE `comments` SET `text`= ? , `edited`=1 WHERE `id`=  ? ");
        $stm -> bindValue(1, $_POST['comment'], PDO::PARAM_STR);
            $stm -> bindValue(2, $id, PDO::PARAM_INT);
            $stm->execute();

           ?>Готово,<br><br><a href="browse.php?id=<?php echo $komentar['zakoqpesen']; ?>">Кликнете,ако не Ви пренасочи</a>
           <META HTTP-EQUIV="refresh" content="1;URL=browse.php?id=<?php echo $komentar['zakoqpesen']; ?>"><?php
           die();
    }

}

require SITE_PATH_TEMPLATE . 'komentar_edit.php';
