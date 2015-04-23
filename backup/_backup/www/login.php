<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */

require '__top.php';

$bez_reklami = true;

//ако формата е изпълнена
if (isset($_POST['submit'])) {



    // проверява дали полетата са попълнени
    if (!$_POST['username'] || !$_POST['pass']) {
        echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=login.php?error=1\">";
        die();
    }

    $remember = isset ($_POST['remember']);
    $loginStatus = Authentication::logIn($_POST['username'], $_POST['pass'], $remember);



    switch ($loginStatus) {
        case Authentication::usernameNotFound:
            echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=login.php?error=2\">";
            die();

            break;
        case Authentication::passwordWrong:
            echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=login.php?error=3\">";
            die();
            break;
        case Authentication::banned:
            echo 'този потребител временно няма да може да се ползва';
            die();
            break;
        case true:
            ?>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <a href="index.php">redirecting...</a>
            <META HTTP-EQUIV="refresh" content="1;URL=index.php">
            <?php
            die();
            break;
        default:
            greshka('LogIn status error ' . print_r($loginStatus, true));
    }
} else {

    require SITE_PATH_TEMPLATE . 'login.php';
}