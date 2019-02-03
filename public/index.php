<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

// see https://github.com/Tekstove/Tekstove/issues/80
//Request::setTrustedHeaderName(Request::HEADER_FORWARDED, null);
Request::setTrustedProxies(
    [
        '127.0.0.1',
        // cloudlfare
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '104.16.0.0/12',
        '108.162.192.0/18',
        '131.0.72.0/22',
        '141.101.64.0/18',
        '162.158.0.0/15',
        '172.64.0.0/13',
        '173.245.48.0/20',
        '188.114.96.0/20',
        '190.93.240.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '199.27.128.0/21',
    ],
    Request::HEADER_X_FORWARDED_FOR
);

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

// I know this is ugly...but...sry...
function errorToException($errNumber, $errMsg, $errFile, $errLine) {

    if (error_reporting() === 0) {
        return true;
    }

    $errorMsg = "Error#{$errNumber}. $errMsg in $errFile : $errLine";
    \error_log($errorMsg);

    throw new \Exception($errMsg);
}

set_error_handler('errorToException');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
