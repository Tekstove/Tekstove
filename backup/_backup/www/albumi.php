<?php

Require ("__top.php");

if (isset($_GET['album_vid'])) {
    $album_vid = (integer) $_GET['album_vid'];
} else {
    $album_vid = NULL;
}

if (isset($_GET['stranica'])) {
    $stranica = (integer) $_GET['stranica'];
} else {
    $stranica = 0;
}

$stranica_limit = $stranica * 16;

if ($album_vid) {
    $stm = $pdo->prepare("SELECT * FROM `albums` WHERE `vid` = ? ORDER BY `id` DESC  LIMIT ? ,17");
    $stm->bindParam(1, $album_vid, PDO::PARAM_INT);
    $stm->bindParam(2, $stranica_limit, PDO::PARAM_INT);
} else {
    $stm = $pdo->prepare("SELECT * FROM `albums` ORDER BY `id` DESC LIMIT ? ,17");
    $stm->bindParam(1, $stranica_limit, PDO::PARAM_INT);
}

$stm->execute();

$albumi = $stm->fetchAll();

Require (SITE_PATH_TEMPLATE . "albumi.php");
