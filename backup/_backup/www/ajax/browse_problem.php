<?php


if(!isset ($_GET['problem']) || !isset ($_GET['url'])) die('error');



Require('../__top.php');

$check = $_GET['problem'];
$check = str_replace('Грешен текст', '', $check);
$check = str_replace('Грешен превод', '', $check);

if(strlen($check)<5) die();

if(strlen($_GET['problem'])<5)die();

$url = htmlspecialchars($_GET['url']);

$problem = htmlspecialchars($_GET['problem']);

if(isset ($_GET['lyric_id']))
{
    $lyricId = (int)$_GET['lyric_id'];
}
else
{
    $lyricId = NULL;
}

//var_dump($username_id);

try{

$stm = $pdo->prepare("INSERT INTO `problemi` (`url`,`problem`, `ot_user_id`, `lyric_id`) VALUES (?, ?, ?, ?)");

$stm -> bindValue(1, $url, PDO::PARAM_STR);
$stm -> bindValue(2, $problem, PDO::PARAM_STR);
$stm -> bindValue(3, $username_id, PDO::PARAM_INT);

if($lyricId)
{
    $stm->bindValue(4, $lyricId, PDO::PARAM_INT);
}
else
{
    $stm->bindValue(4, NULL, PDO::PARAM_NULL);
}

$stm->execute();

}

catch (Exception $e){
    greshka($e);
}


die(1);