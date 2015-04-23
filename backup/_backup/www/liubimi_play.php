<?php Require("__top.php");

try{

   // potrebitel::zadaljitelno_lognat($username_id);

if(isset ($_GET['id'])){
	$id=(int)$_GET['id'];
	$stm = $pdo->prepare("SELECT `username` FROM `users` WHERE `id` = ? LIMIT 1");
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

	if($stm->rowCount() == 0)
                greshka('Не е посочен потребител','Не е посочен потребител');

	$stm = $pdo->prepare("
	SELECT `lyric`.`id`, `lyric`.`video_vbox7`, `lyric`.`video_youtube`, `lyric`.`video_metacafe`, `lyric`.`zaglavie_sakrateno` AS `zaglavie`
	FROM `liubimi` LEFT JOIN `lyric`
	ON `liubimi`.`pesen`=`lyric`.`id`
        WHERE `liubimi`.`username`= ?      ");

        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

	$broi_pesni = $stm->rowCount();
        if($broi_pesni == 0 ) greshka('','Потребителят няма любими песни', 200);

        $pesni = $stm->fetchAll();

}// ID slu6ai liubimi

else if(isset ($_GET['ispalnitel'])){
$id=(int)$_GET['ispalnitel'];

$stm = $pdo->prepare("SELECT `name` FROM `artists` WHERE `id` = ? LIMIT 1");

$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->execute();



	$stm = $pdo->prepare("SELECT `id`, `video_vbox7`, `video_youtube`, `video_metacafe`, `title` AS `zaglavie` FROM `lyric` WHERE (
	`artist1` = :id	OR `artist2` = :id OR `artist3` = :id OR `artist4` = :id OR `artist5` = :id OR `artist6` = :id )");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        $broi_pesni = $stm->rowCount();

        if($broi_pesni == 0 ) greshka('', 'Изпълнителят няма песни', TRUE);

        $pesni = $stm->fetchAll();



} // if($_GET['izpalnitel'])

else {
greshka('грешно слушане песни', 'не е посочен изпълнител/потребител');
}



//var_dump($pesni);



}
catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "liubimi_play.php");
