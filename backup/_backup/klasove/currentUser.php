<?php

/**
 * Description of currentUser
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class currentUser
{

    private static $instance = null;

    private function __construct()
    {
        self::$instance = new potrebitel(array(
            'id' => $_SESSION['id'],
            'username' => $_SESSION['usernameClean'],
            'class' => $_SESSION['class'],
            'classCustomName' => isset($_SESSION['classCustomRankName']) ? $_SESSION['classCustomRankName'] : '',
            'password' => null,
            'avatar' => $_SESSION['avatar'],
        ));
    }

    /**
     *
     * @return potrebitel
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new potrebitel(array(
                'id' => $_SESSION['id'],
                'username' => $_SESSION['usernameClean'],
                'class' => $_SESSION['class'],
                'classCustomName' => isset($_SESSION['classCustomRankName']) ? $_SESSION['classCustomRankName'] : '',
                'password' => null,
                'avatar' => $_SESSION['avatar'],
            ));
        }

        return self::$instance;
    }

    /**
     * 
     * @return boolean
     */
    public static function isLogged()
    {
        if (self::$instance === null) {
            return false;
        } else {
            return true;
        }
    }

}
