<?php

/* @var $pdo pdo */

//проверява дали има сетната бисквитка, за да потвърди дали сте логнати
$username_autoplay = 1;
$username = NULL;
$username_id = 0;
$userclass = NULL;
$user_menu = '<a href="/login.php">Вход</a>&nbsp;&nbsp;<a href="/registeruser.php">Регистрация</a>';

if (!empty($_SESSION['id']) && $_SESSION['ip'] === $_SERVER['REMOTE_ADDR']
        && $_SESSION['agent'] == (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '')
) {

	// disable ads for logged users
	Tekstove\Registry::getInstance()->setAdsense(FALSE);
	currentUser::getInstance();
    $username_id = $_SESSION['id'];
    $username_autoplay = $_SESSION['autoplay'];
    $username = $_SESSION['username'];
    $username_avatar = $_SESSION['avatar'];
    $user_menu = '<a href="/profile.php?profile=' . $username_id . '">' . '<b>' . currentUser::getInstance()->getUsername() . '</b></a>
				&nbsp;<a href="/profileedit.php"  class="top">Потребителски данни</a>';

    $userclass = $_SESSION['class'];
    if ($userclass >= 10) {
        $user_menu .= '&nbsp;<a href="/mod.php">mod</a>';
    }

    $user_menu .= '<form style="display: inline;" action="/logout.php" method="post"><input type="hidden" name="logout" value="1"><input type="submit" value="Изход"
					  style=" background-color: #000; border: none; color: #FFF;cursor:pointer;"></form>';
}
