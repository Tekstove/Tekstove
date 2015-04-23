<?php
Require('../__top.php');

try{

if($userclass<20) greshka('dostapat otkazan', 'Достапът отказан');

if(isset ($_REQUEST['problemi_iztrii'])){
    $stm = $pdo->prepare("DELETE FROM `problemi` WHERE `id` = ? ");
    $stm -> bindValue(1, $_REQUEST['problemi_iztrii'], PDO::PARAM_INT);
    $stm -> execute();
}


if (!empty($_REQUEST['lyric_id'])){
    $stm = $pdo->prepare("DELETE FROM `problemi` WHERE `lyric_id` = ? ");
    $stm -> bindValue(1, $_REQUEST['lyric_id'], PDO::PARAM_INT);
    $stm -> execute();
    
    if($stm->rowCount() > 0)
    {
        die('refresh');
    }
}


}

catch (Exception $e){
    greshka($e);
}

?>