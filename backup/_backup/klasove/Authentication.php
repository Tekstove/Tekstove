<?php

/**
 * Description of Auth
 *
 * @author po_taka
 */
class Authentication {
    const cookieAutoReLoginName = '074h9fssdsASDsadjsoijf2309f38hfFFfgsdfDfdDS';
    const cookieId = 'id';

    const success = 1;

    const usernameNotFound = -1;
    const passwordWrong = -2;
    const banned = -3;

    /**
     * Return true on succes <br />
     * return negative intefer on fail
     * 
     * @param string $user
     * @param string $pass
     * @param bool $remember
     * @return int
     */
    public static function logIn($user, $pass, $remember = false) {

        $pdo = PDOX::singleton();
        // проверява дали има такъв потребител с такава парола
        $stm = $pdo->prepare("SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
        $stm->bindValue(1, $user, PDO::PARAM_STR);
        $stm->execute();


        if ($stm->rowCount() == 0) {
            return self::usernameNotFound;
        }


        $r = $stm->fetch();
        $pass = md5($pass);

        //gives error if the password is wrong
        if ($pass != $r['password']) {
            return self::passwordWrong;
        }

        // if is banned
        $nowTemp = strtotime("now");
        $banTimeTemp = strtotime($r['banned']);
        if ($banTimeTemp > $nowTemp) {
            $minutesTemp = ($banTimeTemp - $nowTemp) / 60;
            $minutesTemp = (int) $minutesTemp;
            ban::newBanIP($_SERVER['REMOTE_ADDR'], $minutesTemp, NULL, "{$r['username']} is banned");
            return self::banned;
        }


        self::loginSetSession($r);

        if ($remember) {
            setcookie(self::cookieId, $_SESSION['id'], time() + 60 * 60 * 24 * 30, '/', NULL, NULL, true);
            $tempCookiePass = $pass . self::getClientFingerPrint();
            $tempCookiePass = md5($tempCookiePass);
            setcookie(self::cookieAutoReLoginName, $tempCookiePass, time() + 60 * 60 * 24 * 30, '/', NULL, NULL, true);
        }

        return self::success;
    }
    
    private static function loginSetSession(array $data) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = htmlspecialcharsX($data['username']);
        $_SESSION['usernameClean'] = $data['username'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['agent'] = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        $_SESSION['class'] = $data['class'];
        $_SESSION['avatar'] = htmlspecialcharsX($data['avatar']);
        $_SESSION['autoplay'] = $data['autoplay'];
		$_SESSION['classCustomRankName'] = $data['classCustomName'];
		if ($data['banned']) {
			$_SESSION['banned'] = $data['banned'];
		}
    }

    public static function loginAuto() {

        if (!isset($_COOKIE['id']) || !isset($_COOKIE[self::cookieAutoReLoginName])) {
            self::clearAutoLogin();
            return false;
        }

        $id = (int) $_COOKIE['id'];
		if ($id <= 0) {
			return false;
		}
        $passCode = $_COOKIE[self::cookieAutoReLoginName];

        try {
            $user = new potrebitel($id);
        } catch (Exception $e) {
            if ($e->getCode() == 404) {
                self::clearAutoLogin();
                return false;
            }
        }
        
        $passCodeCheck = md5($user->getPassword() . self::getClientFingerPrint());
        if ($passCodeCheck !== $passCode) {
            self::clearAutoLogin();
            return false;
        }
        
        self::loginSetSession($user->getDataToArray());
        return true;
        
        
    }

    public static function clearAutoLogin() {
        setcookie('id', '', time() - 3600);
        setcookie(self::cookieAutoReLoginName, '', time() - 3600);
    }

    public static function getClientFingerPrint() {
        // some random sting :)
        $salt = 'gbh%3D1%26guest%3D';

        $salt .= $_SERVER['REMOTE_ADDR'];
        $salt .= (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');

        $salt = md5($salt);
    }

}
