<?php

Require("__top.php");


if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)) {
    $sqlCategoryWhere = '';
} else {
    $sqlCategoryWhere = ' AND `hidden` = 0 ';
}

$stm = $pdo->prepare("
    SELECT
        *
    FROM
        `forum_razdel`
    WHERE
        1 = 1
    {$sqlCategoryWhere}
    ORDER BY
        `podredba`
");
$stm->execute();

$razdeli = $stm->fetchAll();

foreach ($razdeli as $k => &$v) {

    $v['name'] = htmlspecialchars($v['name']);

    $stm = $pdo->prepare("SELECT COUNT(`id`) AS `kolko` FROM `forum_topic` WHERE `topic_razdel`= ? LIMIT 1");
    $stm->bindValue(1, $v['id'], PDO::PARAM_INT);
    $stm->execute();

    $temp = $stm->fetch();
    $v['temi'] = $temp[0];


    $stm = $pdo->prepare("SELECT `id`, `topic_name` FROM `forum_topic` WHERE `topic_razdel` = ? ORDER BY `topic_posleden_post` DESC LIMIT 1");
    $stm->bindValue(1, $v['id'], PDO::PARAM_INT);
    $stm->execute();

    $v['topic'] = $stm->fetch();



    $stm = $pdo->prepare("SELECT `poster` FROM `forum_posts` WHERE `za_topic_id` = ? ORDER BY `id` DESC LIMIT 1");
    $stm->bindValue(1, $v['topic']['id'], PDO::PARAM_INT);
    $stm->execute();

    $temp = $stm->fetch();

    $v['mnenie_id'] = $temp['poster'];
    $v['mnenie_ime'] = potrebitel::ime_ot_id($temp['poster']);
}
unset($v); // reference break

Require (SITE_PATH_TEMPLATE . "forum.php");
