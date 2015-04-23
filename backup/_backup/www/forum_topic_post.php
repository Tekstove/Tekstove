<?php
require ("__top.php");

$bez_reklami = true;
potrebitel::zadaljitelno_lognat($username_id);



if (!isset($_REQUEST['id'])) {
    greshka('Ненамерене тема ' . htmlspecialchars($_REQUEST['id']), 'Грешка,<br>Ненамерене тема ' . htmlspecialchars($_GET['id']));
}

$id = (int) $_REQUEST['id'];

$topic = new \Tekstove\Forum\Topic($id);

$stmCategory = $pdo->prepare("
    SELECT
        *
    FROM
        forum_razdel
    WHERE
        `id` = :id
");

$stmCategory->bindValue('id', $topic->getCategoryId());
$stmCategory->execute();

$category = new Tekstove\Forum\Category($stmCategory->fetch());

if ($category->getHidden() > 0 && 
        (
            false === currentUser::isLogged()
            || 0 == currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)
        )
    ) {
    greshka('access denied', 'достъпът отказан');
}


if (isset($_POST['post_text']) && $_POST['post_text']) {

    $stm = $pdo->prepare("INSERT INTO `forum_posts` (`post`, `za_topic_id`, `poster`) VALUES (?, ?, ?)");
    $stm->bindValue(1, $_POST['post_text'], PDO::PARAM_STR);
    $stm->bindValue(2, $id, PDO::PARAM_INT);
    $stm->bindValue(3, $username_id, PDO::PARAM_INT);
    $stm->execute();

    $stm = $pdo->prepare("UPDATE `forum_topic` SET `topic_posleden_post`= CURRENT_TIMESTAMP WHERE `id` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->execute();

    $topic = new topic($id);
    $topic->informWatchers();
    $topic->addWatcher($_SESSION['id']);
    ?><br>Мнението успешно записано
        <br>
        <a href="forum_topic_vij.php?id=<?php echo $id; ?>">кликнете,ако не бъдете пренасочени</a>
        <META HTTP-EQUIV="refresh" content="0;URL=forum_topic_vij.php?id=<?php echo $id; ?>">
    <?php
    die();
} // post



require (SITE_PATH_TEMPLATE . "forum_topic_post.php");
