<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */

Require("__top.php");

potrebitel::zadaljitelno_lognat($username_id);


try{

$stm = $pdo->prepare('SELECT * FROM `lyric-iztriti` ORDER BY `id` DESC LIMIT 20');
$stm -> execute();


$pesni = NULL;
if($stm->rowCount() > 0 ) foreach ($stm->fetchAll() as $v){


$pesni[] = array(
'id' => $v['id'],
'zaglavie' => $v['zaglavie_sakrateno'],
'text' => nl2br(htmlspecialcharsX($v['text'])),
'text_bg' => nl2br(htmlspecialcharsX($v['text_bg'])),
'prichina' => nl2br(bbcode_format(htmlspecialcharsX($v['prichina']))),
'iztril_id' => $v['id_ztril'],
'iztril_ime' => potrebitel::ime_ot_id($v['id_ztril']),
'up_name' => potrebitel::ime_ot_id($v['up_id']),
'lyric_id' => $v['lyric_id'],
);


}


}
catch (Exception $e){
    greshka($e);
}




require (SITE_PATH_TEMPLATE . "browse_deleted.php");
?>