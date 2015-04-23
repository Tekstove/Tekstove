<?php

Require("__top.php");

try {

    if (isset($_GET['page'])) {
        $page = (integer) $_GET['page'];
    }
    else
        $page = 0;

    $linkfiltyr_sort = NULL;
    $linkfiltyr = NULL;

    if (isset($_GET['filtar'])) {
        $stm = $pdo->prepare('SELECT * FROM `users` WHERE LOWER(`username`) LIKE LOWER(?) ORDER BY `id` DESC LIMIT ? ,31');
        $stm->bindValue(1, '%' . $_GET['filtar'] . '%', PDO::PARAM_STR);
        $stm->bindValue(2, $page * 30, PDO::PARAM_INT);

        $linkfiltyr = '&filtar=' . urlencode($_GET['filtar']);
    } else {



        unset($stm);

        if (isset($_GET['potrebiteli_sort'])) {
            if ($_GET['potrebiteli_sort'] == 2)
                $stm = $pdo->prepare("SELECT * FROM `users` ORDER BY `username` LIMIT ? ,31");
            else if ($_GET['potrebiteli_sort'] == 3)
                $stm = $pdo->prepare("SELECT * FROM `users` ORDER BY `br_pesni` DESC LIMIT ? ,31");
            $linkfiltyr_sort = '&potrebiteli_sort=' . (int) $_GET['potrebiteli_sort'];
        }
        if (!isset($stm)) {
            $stm = $pdo->prepare("SELECT * FROM `users` ORDER BY `id` DESC  LIMIT ? ,31");
        }

        $stm->bindValue(1, $page * 30, PDO::PARAM_INT);
    }

    $stm->execute();

    $users = $stm->fetchAll();
    foreach ($users as &$u) {
        $u = new potrebitel($u);
    } unset($u);
} catch (Exception $e) {
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "potrebiteli.php");
?>