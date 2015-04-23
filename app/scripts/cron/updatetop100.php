<?php
require __DIR__ . '/__cli.php';

$stm = $pdo->prepare('SELECT * FROM `novini` WHERE ( CURDATE() > `data`  )');
$stm -> execute();
foreach ($stm->fetchAll() as $r) {

    echo htmlspecialchars($r['data'].' '.$r['text']).'<hr>';


    $stm = $pdo->prepare('UPDATE `forum_topic` SET `topic_razdel` =  8 WHERE `id` = ? LIMIT 1');
    $stm -> bindValue(1, $r['id'], PDO::PARAM_INT);
    $stm -> execute();

}

$stm = $pdo->prepare('DELETE FROM `novini` WHERE ( CURDATE() > `data`  )');
$stm -> execute();

$stm = $pdo->prepare('DELETE FROM `pm` WHERE `data` < DATE_SUB(CURDATE(), INTERVAL 45 DAY) ');
$stm -> execute();
echo $stm->rowCount().' изтрити ЛС<br>';


echo "готово";
