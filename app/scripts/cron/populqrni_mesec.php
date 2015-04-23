<?php
require __DIR__ . '/__cli.php';

try{
$stm = $pdo->prepare("UPDATE `lyric` SET `populqrnost`=(`populqrnost`/2) WHERE `populqrnost`>0");
$stm -> execute();
	
	
$info = "Популярност на песните на две готово";

zapis($info);
}
catch (Exception $e){
    greshka($e);
}

echo $info;