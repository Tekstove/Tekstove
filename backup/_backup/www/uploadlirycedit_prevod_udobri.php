<?php
Require ("__top.php");

/* @var $pdo PDO */

if (isset($_REQUEST['id'])) {
    $id = (integer) $_REQUEST['id'];
} else {
    greshka('ne e poso4eno ID');
}

potrebitel::zadaljitelno_lognat($username_id);

$currentUser = currentUser::getInstance();

$stm = $pdo->prepare("SELECT * FROM `edit_add_prevod` WHERE `id` = ? LIMIT 1");

$stm->bindValue(1, $id, PDO::PARAM_INT);

$stm->execute();

if ($stm->rowCount() == 0) {
    greshka('Не намирам превода', 'не намирам превода');
}

$data = $stm->fetch();
if (($data['za_user_id'] != $username_id ) && (false == currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::LYRIC_TRANSLATION_CONFIRM))) {
    greshka('Достъпът отказан', 'Достъпът отказан');
}

$text_prevod = $data['text'];
$za_pesen = $data['za_pesen'];
$prevod_ot = $data['ot'];
$lyric = new lyric((int) $za_pesen);




if (!isset($_POST['deistvie'])) {

    Require(SITE_PATH_TEMPLATE . '__top.php');
    ?><form action="" method="post" ><?php
    ?><table border=1><tr>
                <td>Предложен превод</td><td>Текст</td>
                <?php if ($lyric->getText_bg(1, 1)) { ?><td>Вече има превод</td><?php } ?>
            </tr>
            <tr>

                <td style="background-color: #DDDDDD;vertical-align: top;">

                    <textarea class="textarea_resizable" name ="prevod" cols="65" rows="30" wrap="off" ><?php echo htmlspecialcharsX($text_prevod); ?></textarea>

                </td>
                <td style="vertical-align: top;">

                    <textarea class="textarea_sync_resize" cols="65" rows="30" wrap="off" readonly><?php echo $lyric->getText(true, false); ?></textarea><?php
                    //Ако има превод;	
                    if ($lyric->getText_bg(false, false)) {
                        ?>
                    </td>
                    <td style="vertical-align: top;">
                        <textarea class="textarea_sync_resize" cols="65" rows="30" wrap="off" readonly><?php echo $lyric->getText_bg(true, false) ?></textarea><?php
                    }//Край ако има превод
                    ?>
                </td>
            </tr>
        </table>
        <select name="deistvie">
            <option selected value="1">Одобри превода
            <option value="2">Отхвърли превода
        </select>

        <input type="hidden" name="id" maxlength="11" size=11 value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="subjoin" value="Напред">
    </form>
    <?php
    Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
    die();
}

if (isset($_POST['deistvie'], $_REQUEST['id'], $_POST['prevod']) && $_POST['deistvie'] == 1) {


    $ubnovi_dop_info = PHP_EOL . 'превод изпратен от [url=http://tekstove.info/profile.php?profile=' . $prevod_ot . ']' . potrebitel::ime_ot_id($prevod_ot, 1) . '[/url]';
    potrebitel::addActivityPoints($prevod_ot, 35);

    $stm = $pdo->prepare("UPDATE `lyric` SET `text_bg`= ? ,`podnovena`=CURRENT_TIMESTAMP, `dopylnitelnoinfo`=CONCAT(`dopylnitelnoinfo`, ? ) WHERE `id`= ? LIMIT 1");
    $stm->bindValue(1, $_POST['prevod'], PDO::PARAM_STR);
    $stm->bindValue(2, $ubnovi_dop_info, PDO::PARAM_STR);
    $stm->bindValue(3, $za_pesen, PDO::PARAM_INT);
    $stm->execute();

    $stm = $pdo->prepare("DELETE FROM `edit_add_prevod` WHERE `id` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->execute();

    $stm = $pdo->prepare("
			INSERT INTO `pm`(`za`, `ot`,`text`,`otnosno`)
				VALUES(:for, :from, :msg, :title)
			");
    $stm->bindValue('for', $prevod_ot, PDO::PARAM_INT);
    $stm->bindValue('from', $currentUser->getId(), PDO::PARAM_INT);
    $msgText = <<<MSG
превод за [b]{$lyric->getTitle(false)}[/b] е одобрен
[url=http://tekstove.info/browse.php?id={$lyric->getId()}]към песента[/url]
MSG;
    $stm->bindValue('msg', $msgText, PDO::PARAM_STR);
    $stm->bindValue('title', 'одобрен превод', PDO::PARAM_STR);
    $stm->execute();
    ?><br>Заявката премаханта.<br>
    <br>
    <a href="browse.php?id=<?php echo $za_pesen; ?>">към песента</a>
    <META HTTP-EQUIV="refresh" content="1;URL=browse.php?id=<?php echo $za_pesen; ?>">

    <?php
    die();
} else if (isset($_POST['deistvie']) && $_POST['deistvie'] == 2) {
    $stm = $pdo->prepare("DELETE FROM `edit_add_prevod` WHERE `id` = ? LIMIT 1");
    $stm->bindValue(1, $id, PDO::PARAM_INT);
    $stm->execute();

    $stm = $pdo->prepare("
			INSERT INTO `pm`(`za`, `ot`,`text`,`otnosno`)
				VALUES(:for, :from, :msg, :title)
			");
    $stm->bindValue('for', $prevod_ot, PDO::PARAM_INT);
    $stm->bindValue('from', $currentUser->getId(), PDO::PARAM_INT);
    $stm->bindValue('msg', 'превод за [b]' . $lyric->getTitle(false) . '[/b] е отхвърлен');
    $stm->bindValue('title', 'отхвърлен превод');
    $stm->execute();

    greshka(NULL, '<META HTTP-EQUIV="refresh" content="1;URL=uploadlirycedit_prevod_vij_zaqvki.php">Заявката премаханта.');
}
