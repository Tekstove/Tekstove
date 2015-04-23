<?php
/**
 * BRUTAL GSP
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$_SERVER['REQUEST_METHOD'] = 'GET';
} else {
	greshka('logout s method ne post');
}

require '__top.php';

if (isset($_POST['logout'])) {

    foreach ($_SESSION as $k => $v) {
        unset($_SESSION[$k]);
    }

    if (session_destroy () === false) {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 86400, '/');
        }
        session_destroy();
    }
    
    Authentication::clearAutoLogin();
}
header("Location: /index.php");
?>
<meta http-equiv="Refresh" content="3;URL=/"/>