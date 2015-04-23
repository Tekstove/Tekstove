<?php
Require("__top.php");

$bez_reklami = true;
if ($username_id == 90) {
    die('Тестовият профил няма права за промяна');
}

if (false === currentUser::isLogged()) {
    throw new Exception('in order to edit post, user must be logged in');
}
potrebitel::zadaljitelno_lognat($username_id);


if (!isset($_REQUEST['id'])) {
    greshka('не е посочен ид', 'Не е посочено мнение за промяна');
}
$id = (int) $_REQUEST['id'];

$stm = $pdo->prepare("SELECT * FROM `forum_posts` WHERE `id` = ? LIMIT 1");
$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->execute();

$post_data = $stm->fetch();
$post_data['post'] = htmlspecialchars($post_data['post']);

if ($stm->rowCount() == 0) {
    greshka('nqma meneie', 'не намирам мнението');
}

if (($post_data['poster'] != currentUser::getInstance()->getId()) && $userclass < 20) {
    greshka('edit na 4ujd post', 'Опитваш се да промениш чуждо мнение');
}


if (isset($_POST['post'])) {

    if (isset($_POST['iztrii']) && $_POST['iztrii']) {
        $stm = $pdo->prepare("DELETE FROM `forum_posts` WHERE `id` = ? LIMIT 1");
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

        echo 'изтрито';
        die();
    }


    $stm = $pdo->prepare("UPDATE `forum_posts` SET `post` = ? WHERE `id` = ? ");
    $stm->bindValue(1, $_POST['post'], PDO::PARAM_STR);
    $stm->bindValue(2, $id, PDO::PARAM_INT);
    $stm->execute();
    ?><a href="forum_topic_vij.php?id=<?php echo $post_data['za_topic_id']; ?>">Готово, Обратно към темата</a>
    <?php
    die();
}


require (SITE_PATH_TEMPLATE . 'forum_post_edit.php');

