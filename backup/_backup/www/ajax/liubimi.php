<?php

require "../__top.php";

if (false === currentUser::isLogged()) {
    throw new \Exception('user not logged');
}

$action = $_POST['action'];

$id = (int) $_POST['id'];

if ($action === 'add') {
    $stm = $pdo->prepare("SELECT `id` FROM `liubimi` WHERE `pesen` = ? AND `username` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->bindValue(2, $username_id, PDO::PARAM_INT);

    $stm->execute();

    if ($stm->rowCount() >= 1) {
        die("4");
    }

    $stm = $pdo->prepare("INSERT INTO `liubimi` (`username`, `pesen`) VALUES ( ?, ?)");
    $stm->bindValue(1, $username_id, PDO::PARAM_INT);
    $stm->bindValue(2, $id, PDO::PARAM_INT);
    $stm->execute();
    die("1");
} elseif ($action === 'remove') {
    $stm = $pdo->prepare("SELECT `id` FROM `liubimi` WHERE `pesen` = ? AND `username`= ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->bindValue(2, $username_id, PDO::PARAM_INT);
    $stm->execute();

    if ($stm->rowCount() == 0) {
        die("5");
    }
    $stm = $pdo->prepare("DELETE FROM `liubimi` WHERE `pesen` = ? AND `username` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->bindValue(2, $username_id, PDO::PARAM_INT);
    $stm->execute();
    die("2");
}


// 1 - добавена
// 2 - изтрита
