<?php
Require("__top.php");

potrebitel::zadaljitelno_lognat($username_id);

$bez_reklami = true;

if (isset(
        $_POST['profile_edit_password_change'],
        $_POST['password_change_old_pass'],
        $_POST['password_change_new_pass'],
        $_POST['password_change_new_pass_again']
        )) {

    $oldPass = trim($_POST['password_change_old_pass']);
    $newPass = trim($_POST['password_change_new_pass']);
    $newPass2 = trim($_POST['password_change_new_pass_again']);

    if (mb_strlen($newPass) < 3 | mb_strlen($newPass2) < 3) {
        $errors = 'Паролата трябва да е поне 3 знака';
    } else {
        if ($newPass !== $newPass2) {
            $errors = 'Потвържението на новата парола не съвпада';
        } else {
            $stm = $pdo->prepare('SELECT * FROM `users` WHERE `id` = ? ');
            $stm->bindValue(1, $username_id, PDO::PARAM_INT);
            $stm->execute();
            if ($stm->rowCount() == 0) {
                unset($stm);
                trigger_error('user not found' . print_r($_REQUEST, 1));
            }

            $userData = $stm->fetch();

            if (md5($oldPass) !== $userData['password']) {
                $errors = 'Старата ти парола е невярна';
            } else {
                $stm = $pdo->prepare('UPDATE `users` SET `password` = :pass WHERE `id` = :id LIMIT 1');
                $stm->bindValue(':pass', md5($newPass));
                $stm->bindValue(':id', $username_id);
                $stm->execute();

                $errors = 'Паролата ти е сменена';

                unset($stm);
            }
        }
    }
}




if (isset($_POST['profileedit'])) {

    if (isset($_POST['skype']))
        $skype = trim($_POST['skype']);
    else
        $skype = NULL;
    if (!preg_match('|^[a-zA-Z0-9\_\-\.]*$|', $skype)) {
        $skype = NULL;
    }

    if (isset($_POST['autoplay']) && $_POST['autoplay'])
        $autoplay = 1;
    else
        $autoplay = 0;

    $_SESSION['autoplay'] = $autoplay;

    if (isset($_POST['pozdrav']) && $_POST['pozdrav'])
        $pozdrav = (integer) str_replace("http://tekstove.info/browse.php?id=", "", $_POST['pozdrav']);
    else
        $pozdrav = NULL;

    if (isset($_POST['about']))
        $about = $_POST['about'];
    else
        $about = NULL;

    if (isset($_POST['avatar'])) {
        $avatar = trim($_POST['avatar']);
        if (!preg_match('/^http/iu', $avatar)) {
            $avatar = NULL;
        }
    } else {
        $avatar = NULL;
    }

    $_SESSION['avatar'] = $avatar;

    $stm = $pdo->prepare("UPDATE `users` SET
    `about` = ? ,`avatar` = ?, `pozdrav` = ?, `autoplay`= ?,`skype` = ?
        WHERE `id`= ? LIMIT 1");
    $stm->bindValue(1, $about, PDO::PARAM_STR);
    $stm->bindValue(2, $avatar, PDO::PARAM_STR);
    $stm->bindValue(3, $pozdrav, PDO::PARAM_STR);
    $stm->bindValue(4, $autoplay, PDO::PARAM_INT);
    $stm->bindValue(5, $skype, PDO::PARAM_STR);
    $stm->bindValue(6, $username_id, PDO::PARAM_INT);
    $stm->execute();

    if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::USER_CHANGE_OWN_RANG)) {
        if (!isset($_POST['level'])) {
            greshka('missing level as param');
        }

        $level = htmlspecialcharsX($_POST['level']);
        $_SESSION['classCustomRankName'] = $level;

        $stm = $pdo->prepare("
            UPDATE
                `users`
            SET
                `classCustomName` = :level
            WHERE
                `id`= :id
            LIMIT 1
        ");
        $stm -> bindValue(':id', $username_id);
        $stm -> bindValue(':level', $level);
        $stm->execute();
    }

    ?>Готово,пренасочване<META HTTP-EQUIV="refresh" content="2;URL=profile.php?profile=<?php echo $username_id; ?>"><?php
    
} else {
    
    require SITE_PATH_TEMPLATE . '__top.php';

    $stm = $pdo->prepare("SELECT * FROM `users` WHERE `id` = ? ");
    $stm->bindValue(1, $username_id, PDO::PARAM_INT);
    $stm->execute();

    $stm_data = $stm->fetch();
?>
    <form action="" method="post">
        Avatar: 
            <span style="font-weight: bold;">
                <a href="http://tekstove.info/forum_topic_vij.php?id=369" target="_BLANK">как да си сложа аватар ?</a>
            </span>
        <br><input type=text name="avatar" maxlength=100 size=40 value="<?php echo htmlspecialchars($stm_data['avatar']); ?>">

        <br>
        <br>Поздрав (линк към песен ,<i>например: <u>http://www.tekstove.info/browse.php?id=28</u></i> )<br>
        <input type=text name="pozdrav" maxlength=100 size=40 value="<?php
                                                            if ($stm_data['pozdrav']):
                                                                echo htmlspecialchars($stm_data['pozdrav']);
                                                            endif;
                                                        ?>">
        <br><br>За мен:<br><textarea name="about" rows=20 cols=60><?php echo htmlspecialcharsX($stm_data["about"]); ?></textarea>

        <br>
        skype: <input type="text" name="skype" value="<?php echo htmlspecialcharsX($stm_data['skype']); ?>">

        <br/>
        <br/>
        <input type="checkbox" name="autoplay" id="autoplay"
            <?php if ($stm_data['autoplay']): ?>
                CHECKED
            <?php endif; ?>
        ><label for="autoplay">Автоматично пускане на клипчета</label>

        <?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::USER_CHANGE_OWN_RANG)) : ?>
        <br/>
        <br/>
        <label for="level">ранг:</label><br/>
        <input type="text" id="level" name="level" class="tooltip"
               value="<?php
                    echo currentUser::getInstance()->getRankAsText();
               ?>"
               title="Не си слагай ранг, заради който ще изгубиш правото да си го сменяш сам!">
        <?php endif; ?>

        <br/>
        <br><input type="submit" name="profileedit" value="Съхрани промените">
    </form>


    <br/>
    <a href="#" onclick="$(this).slideUp(300, function(){$('#profeile_edit_password_change').slideDown(2000)}); return false;"
       style="color: red;<?php if (isset($errors)): ?> display:none;<?php endif; ?>">
        смяна на парола
    </a>
    <div id="profeile_edit_password_change" style="<?php if (empty($errors)): ?>display: none;<?php endif; ?>padding: 25px; border: #44DD44 1px solid;">
            <form action="" method="post">
                  текуща парола:<br>
              <input type="password" name="password_change_old_pass"><br>
                  нова парола<br>
              <input type="password" name="password_change_new_pass"><br>
                  нова парола отново<br>
              <input type="password" name ="password_change_new_pass_again"><br>
              <input type="submit" name="profile_edit_password_change" value="смени">
            <?php if (isset($errors)): ?>
                          <span style="color: red;"><?php echo $errors; ?></span>
            <?php endif; ?>
            </form>
    </div>
	
</body>
</html>
<?php } ?>