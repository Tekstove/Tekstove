<?php
session_start();
// Report all PHP errors
error_reporting(-1);

define('site_url', '/');
define('site_url_ssl', 'https://tekstove.info/');
define('SITE_NAME', 'tekstove.info');

define('SITE_PATH', __DIR__ . '/');

define('SITE_PATH_TEMPLATE', SITE_PATH . 'template/');

define('SITE_STYLE_CSS', '/css/style_2.6.2.css');

define('SITE_JS_JQUERY_VERSION', '1.8.1');
define('SITE_JS_JQUERY_UI_VERSION', '1.10.3');


// set to the user defined error handler
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    $error = "n: $errno <br>error: $errstr <br>file: $errfile <br>line: $errline";
    throw new Exception($error);
}
set_error_handler('myErrorHandler');

/**
 * @param Exception $exception
 */
function myExceptionHandler($exception) {
	$error = "
		file: {$exception->getFile()}
		line: {$exception->getLine()}
		message: {$exception->getMessage()}
		trace: {$exception->getTraceAsString()}
		";
	greshka($error);
}
set_exception_handler('myExceptionHandler');

date_default_timezone_set('Europe/Sofia');

require SITE_PATH.'__functions.php';


class PDOX{
    /**
     * @var PDO
     */
	private static $con = NULL;
	
    public function  __construct() {    greshka('PDO construct error');   }
    /**
     * @return PDO
     */
    public static function singleton() {
        if (PDOX::$con === NULL) {
            try {
                PDOX::$con = new PDO('mysql:host=localhost;dbname=tekstove_lyric', 'tekstove_lyric', 'AmwvtLUuVG3fdSdy');
                PDOX::$con->exec("SET NAMES utf8");
            }
             catch (PDOException $e) {
                switch ($e->getCode()) {
                    case 2002: // SQLSTATE[HY000] [2002] Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (11)
                    case 1040: // too many connection

                        error_log('SQL error: ' . $e->getMessage());
                        msgHelper::siteOverloaded();
                        die();
                        break;

                    default:
                       error_log('SQL error #' . $e->getCode() . ' : ' . $e->__toString());
                       mail('angel.koilov@gmail.com', 'error', $e->__toString());
                       msgHelper::siteOverloaded('Изникна грешка, съжалявам');
                       die();
                }
                 
                 
             
             }
            return PDOX::$con;
        } else {
            return PDOX::$con;
        }
    }

} // PDOX class

 try {
    $pdo = PDOX::singleton();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    greshka($e);
}

if (empty ($_SESSION['id']) && !empty($_COOKIE['id'])) {
    Authentication::loginAuto();
}


if (php_sapi_name() != 'cli' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	
        $ban = ban::autoBan();
	if ($ban !== false) {
		headerHeler::forbidden();
		require SITE_PATH_TEMPLATE . '__banned.php';
		die;
	}
	
	$stm = $pdo->prepare('INSERT INTO `flood_control`(`ip`) VALUES(:ip)');
	$stm->bindValue(':ip', ip2long($_SERVER['REMOTE_ADDR']));
	$stm->execute();
	
}


require SITE_PATH . '__members.php';