<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */
require("../__top.php");


if(!isset ($_GET['id'])) die('-4');
$id=(int)$_GET['id'];
if(!$id) {echo "-1";die();}


try{


    potrebitel::zadaljitelno_lognat($username_id);
	
    $stm = $pdo->prepare("SELECT `ot` FROM `glasuvane` WHERE `za`= ? AND `ot` = ? LIMIT 1");
    $stm->bindParam(1, $id, PDO::PARAM_INT);
    $stm->bindParam(2, $username_id, PDO::PARAM_INT);
    $stm->execute();

    if($stm->rowCount()>0) {echo "-5";die();} // гласувал е


    $pesen = new lyric((int)$id);



    $stm = $pdo->prepare("INSERT INTO `glasuvane` (`za`, `ot`) VALUES (?, ?)");
    $stm->bindParam(1, $id, PDO::PARAM_INT);
    $stm->bindParam(2, $username_id, PDO::PARAM_INT);
    $stm->execute();


    $stm = $pdo->prepare("SELECT COUNT(`id`) AS `kolko` FROM `glasuvane` WHERE `za`= ? ");
    $stm->bindParam(1, $id, PDO::PARAM_INT);
    $stm->execute();

    $broi_glasa = $stm->fetch();
    $broi_glasa = $broi_glasa[0];



    $stm = $pdo->prepare('UPDATE `lyric` SET `glasa` =  ? ,`populqrnost` = (`populqrnost`+200) WHERE `id` = ? LIMIT 1');
    $stm->bindParam(1, $broi_glasa, PDO::PARAM_INT);
    $stm->bindParam(2, $id, PDO::PARAM_INT);
    $stm->execute();

    
    
echo $broi_glasa."<br> Гласа";

}

catch (Exception $e) {
    greshka($e);
}


?>