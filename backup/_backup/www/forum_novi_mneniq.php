<?php
require ("__top.php");

if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)) {
    $sqlCategoryWhere = '';
} else {
    $sqlCategoryWhere = ' AND `hidden` = 0 ';
}

$stm = $pdo->prepare("
    SELECT
        `forum_posts`.*
    FROM
        `forum_posts`
    INNER JOIN
        forum_topic
            ON
                forum_topic.id = forum_posts.za_topic_id
    INNER JOIN
        forum_razdel
            ON
                forum_razdel.id = forum_topic.topic_razdel
                {$sqlCategoryWhere}
    ORDER BY
        `id` DESC
    LIMIT
        20
");

$stm->execute();

foreach ($stm->fetchAll() as $v) {

    $stm = $pdo->prepare('SELECT `username`,`avatar`, `class`, `skype` FROM `users` WHERE `id` = ? LIMIT 1');
    $stm -> bindValue(1, $v['poster'], PDO::PARAM_INT);
    $stm -> execute();
    $user = $stm->fetch();

    $stm = $pdo->prepare('SELECT `topic_name` FROM `forum_topic` WHERE `id` = ? LIMIT 1');
    $stm->bindValue(1, $v['za_topic_id'], PDO::PARAM_INT);
    $stm->execute();

    $topic = $stm->fetch();

$mneniq[] = array(
    'ot' => $v['poster'],
    'skype' => skype_code($user['skype']),
    'username' => htmlspecialchars($user['username']),
    'class' => $user['class'],
    'avatar' => $user['avatar'],
    'data' => $v['date'],
    'text' => nl2br(bbcode_format(htmlspecialchars($v['post']))),
    'topic_name' => htmlspecialchars($topic['topic_name']),
    'topic_id' => $v['za_topic_id']

    );
}


require (SITE_PATH_TEMPLATE . "forum_novi_mneniq.php");
