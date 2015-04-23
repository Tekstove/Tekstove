<?php
Require ("__top.php");

    if (!isset($_GET['id'])) {
        greshka("не e посочено ИД за темата");
    }
    $id = (int) $_GET['id'];
    $stm = $pdo->prepare("SELECT * FROM `forum_topic` WHERE `id` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->execute();

    if ($stm->rowCount() == 0) {
        greshka("не намирам темата", 'Темата е изтрита');
    }

$tema = $stm->fetch();

$stm = $pdo->prepare("SELECT `name`, `id`, `hidden` FROM `forum_razdel` WHERE `id`= ? LIMIT 1");
$stm->bindValue(1, $tema['topic_razdel'], PDO::PARAM_INT);
$stm->execute();
$data = $stm->fetch();

$category = new \Tekstove\Forum\Category($data);

$tema['razdel'] = $category->getId();
$tema['razdel_ime'] = htmlspecialchars($category->getName());

if ($category->getHidden() > 0 && 
        (
            false === currentUser::isLogged()
            || 0 == currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::FORUM_CATEGORY_ACCESS_HIDDEN)
        )
    ) {
    greshka('access denied', 'достъпът отказан');
}

if ($userclass >= 9) {
    if (( $userclass == 9 || $userclass > 10) && ( $tema['razdel'] == 7 )) {
        $stm_novina = $pdo->prepare("SELECT `id` FROM `novini` WHERE `id` = :id LIMIT 1");
        $stm_novina->bindValue(':id', $tema['id'], PDO::PARAM_INT);
        $stm_novina->execute();

        if ($stm_novina->rowCount() > 0) {
            $tema['novina'] = true;
        } else {
            $tema['novina'] = false;
        }

        unset($stm_novina);
    }
}

$stm = $pdo->prepare("SELECT * FROM `forum_posts` WHERE `za_topic_id` = ? ORDER by `id`");
$stm->bindValue(1, $tema['id'], PDO::PARAM_INT);
$stm->execute();

$mneniq = $stm->fetchAll();

$stm = $pdo->prepare("SELECT `username`, `avatar`, `class`, `skype` FROM `users` WHERE `id`= ? LIMIT 1");
foreach ($mneniq as &$v) {
    
    $stm->bindValue(1, $v['poster'], PDO::PARAM_INT);
    $stm->execute();

    $userData = $stm->fetch();

    $v['poster_ime'] = htmlspecialchars($userData['username']);
    $v['poster_avatar'] = $userData['avatar'];
    $v['poster_skype'] = $userData['skype'];
    $v['poster_class'] = $userData['class'];
		
}
unset($v);

require (SITE_PATH_TEMPLATE . "forum_topic_vij.php");
