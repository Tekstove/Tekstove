<?php
require ("__top.php");

if (isset($_GET['razdel'])) {
    $razdel = (int) $_GET['razdel'];
} else {
    greshka(' ненамерен раздел', 'Нямаме такъв раздел в форума');
}



$stm = $pdo->prepare("SELECT * FROM `forum_razdel` WHERE `id` = ? LIMIT 1");
$stm->bindValue(1, $razdel, PDO::PARAM_INT);
$stm->execute();

if ($stm->rowCount() == 0) {
    greshka(htmlspecialchars($_GET['razdel']) . ' ненамерен раздел', 'Нямаме такъв раздел в форума');
}

$stm = $stm->fetch();

$category = new Tekstove\Forum\Category($stm);

if ($category->getHidden() > 0 && 
        (
            false === currentUser::isLogged()
            || 0 == currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)
        )
    ) {
    greshka('access denied', 'достъпът отказан');
}

$razdel_ime = $category->getName();


if (isset($_GET['stranica'])) {
    $stranica = (int) $_GET['stranica'];
} else {
    $stranica = 0;
}

$stm = $pdo->prepare("SELECT * FROM `forum_topic` WHERE `topic_razdel`= ? ORDER BY `priority` DESC, `topic_posleden_post` DESC LIMIT ? ,16");
$stm->bindValue(1, $razdel, PDO::PARAM_INT);
$stm->bindValue(2, $stranica*15, PDO::PARAM_INT);
$stm->execute();

$temi = $stm->fetchAll();

foreach ($temi as &$v) {

    $v['topic_name'] = htmlspecialchars($v['topic_name']);

    $stm = $pdo->prepare("SELECT COUNT(`id`) AS `kolko` FROM `forum_posts` WHERE `za_topic_id` = ? ");
    $stm->bindValue(1, $v['id'], PDO::PARAM_INT);
    $stm->execute();

    $v['topic_broi_mneniq'] = $stm->fetch();
    $v['topic_broi_mneniq'] = $v['topic_broi_mneniq'][0];



    $stm = $pdo->prepare("SELECT * FROM `forum_posts` WHERE `za_topic_id` = ? ORDER BY `id` DESC LIMIT 1");
    $stm->bindValue(1, $v['id'], PDO::PARAM_INT);
    $stm->execute();
    $stm = $stm->fetch();

    $v['poster'] = $stm['poster'];
    $v['poster_ime'] = potrebitel::ime_ot_id($stm['poster']);
    $v['data'] = $stm['date'];
}
unset($v);



require (SITE_PATH_TEMPLATE . "forum_razdel_vij.php");
