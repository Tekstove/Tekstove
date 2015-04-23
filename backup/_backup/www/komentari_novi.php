<?php
Require("__top.php");

if (isset($_GET['page'])) {
    $page = (integer) $_GET['page'];
} else {
    $page = 0;
}

$stm = $pdo->prepare("
    SELECT
        comments.*,
        `username`, `avatar`,
        `zaglavie_sakrateno`
    FROM
        `comments`
    INNER JOIN
        `users`
            ON
                `users`.`id` = `comments`.`sendby`
    INNER JOIN
        `lyric`
            ON
                lyric.id = comments.zakoqpesen
    ORDER BY
        `id` DESC
    LIMIT
        ? ,21
");

$stm -> bindValue(1, $page*20, PDO::PARAM_INT);
$stm -> execute();

$komentari = $stm->fetchAll();

foreach ($komentari as &$v) {

    if (($username_id == $v['sendby']) || ($userclass >= 20)) {
        $v['sobstvenik'] = true;
    } else {
        $v['sobstvenik'] = false;
    }

    $v['pesen_ime'] = htmlspecialchars($v['zaglavie_sakrateno']);

    $v['sendby_ime'] = htmlspecialcharsX($v['username']);
    $v['sendby_avatar'] = htmlspecialcharsX($v['avatar']);

    $v['text'] = nl2br_my(htmlspecialchars($v['text']));

}
unset($v);

Require (SITE_PATH_TEMPLATE . "komentari_novi.php");
