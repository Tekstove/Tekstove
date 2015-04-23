<?php

require '../__top.php';

if (empty ($_GET['id']))
{
	greshka('nqma get id za /ajax/lyric_view');
}

$id = $_GET['id'];


$stm = $pdo->prepare('INSERT INTO `lyric_views`(`lyric_id`, `ip`) VALUES(?, ?) ');
$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->bindValue(2, ip2long($_SERVER['REMOTE_ADDR']));
$stm->execute();