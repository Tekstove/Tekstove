<?php

/* @var $pdo pdo */
/* @var $stm PDOStatement */

Require("__top.php");



if (isset($_POST['z_po6ta'], $_POST['z_godina'])) {

    $rajdane = (int) $_POST['z_godina'] . '%';

    $stm = $pdo->prepare("
        SELECT
            *
        FROM
            `users`
        WHERE 
            LOWER(`mail`) = LOWER( :mail )
            AND `rajdane` LIKE ( :rajdane )
        LIMIT
            1
    ");


    $stm->bindParam(':rajdane', $rajdane, PDO::PARAM_STR);
    $stm->bindParam(':mail', $_POST['z_po6ta'], PDO::PARAM_STR);

    $stm->execute();



    if ($stm->rowCount() == 0) {
        $msg = 'Не намирам нищо';
    } else {
        $stm = $stm->fetch();
        $msg = 'Намерих потребител с име: ' . htmlspecialcharsX($stm['username']);
    }
}

require SITE_PATH_TEMPLATE . 'login_zabraveno.php';
