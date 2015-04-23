<?php
require __DIR__ . '/__cli.php';

/* @var $pdo PDO */

$stm = $pdo->prepare('SELECT DISTINCT(`lyric_id`) FROM `lyric_views');
$stm->execute();

if ($stm->rowCount() == 0) {
    greshka('0 views cron 10 min');
}


$stmViewsCount = $pdo->prepare('SELECT COUNT(DISTINCT (`ip`)) AS `views` FROM `lyric_views` WHERE `lyric_id` = ? ');
$stmUpdateLyricViews = $pdo->prepare('
UPDATE `lyric`
SET
    `vidqna` = `vidqna` + :views ,
    `populqrnost` = `populqrnost` + :views
WHERE
    `id` = :id'
);

$stmViewsClear = $pdo->prepare('DELETE FROM `lyric_views` WHERE `lyric_id` = ? ');

foreach ($stm->fetchAll() as $v) {
    $lyricID = $v['lyric_id'];

    $stmViewsCount->bindValue(1, $lyricID, PDO::PARAM_INT);
    $stmViewsCount->execute();

    $views = $stmViewsCount->fetch();
    $views = $views['views'];

    $stmUpdateLyricViews->bindValue(':views', $views, PDO::PARAM_INT);
    $stmUpdateLyricViews->bindValue(':id', $lyricID, PDO::PARAM_INT);
    $stmUpdateLyricViews->execute();


    $stmViewsClear->bindValue(1, $lyricID, PDO::PARAM_INT);
    $stmViewsClear->execute();
}

zapis('10 min cron completed successful');

