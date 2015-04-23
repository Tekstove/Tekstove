<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Текстове.инфо</title>
<meta name="author" content="tekstove.info">
<meta name="revisit-after" content="2 days">
<meta name="language" content="bg">

</head>
<body>
<?php

require '../__top.php';

if(!isset ($_GET['id'])) greshka('ne e poso4eno id');

$id = (int)$_GET['id'];


$stm = $pdo->prepare('SELECT * FROM `prevodi` WHERE `id` = ? LIMIT 1');
$stm -> bindValue(1, $id, PDO::PARAM_INT);
$stm -> execute();

$data = $stm -> fetch();

?><h1><?php echo htmlspecialcharsX($data['zaglavie']); ?></h1>
<?php echo nl2br(htmlspecialcharsX($data['text'])); ?>
