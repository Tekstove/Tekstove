<?php
Require("__top.php");


potrebitel::zadaljitelno_lognat($username_id);
$bez_reklami = true;

if (currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::LYRIC_TRANSLATION_CONFIRM)) {
    $stm = $pdo->prepare("SELECT * FROM `edit_add_prevod` ORDER BY `id` DESC");
} else {
    $stm = $pdo->prepare("SELECT * FROM `edit_add_prevod` WHERE `za_user_id` = ? ORDER BY `id` DESC");
    $stm->bindValue(1, $username_id, PDO::PARAM_INT);
}

$stm->execute();

if ($stm->rowCount() == 0)
    greshka(NULL, 'Няма заявки');

$prevodi = $stm->fetchAll();

Require(SITE_PATH_TEMPLATE . '__top.php');
foreach ($prevodi as $v) {
    ?><a href="uploadlirycedit_prevod_udobri.php?id=<?php echo $v['id']; ?>">

        <?php
        $pesen = new lyric((int) $v['za_pesen']);
        echo $pesen->get_Zaglavie_sakrateno();
        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;изпратено от <?php echo potrebitel::ime_ot_id($v['ot']); ?></a><br>

<?php
}




Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
?>