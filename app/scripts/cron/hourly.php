<?php
require __DIR__ . '/__cli.php';

$a = rand(0, 3);

switch ($a) {
    case 0:
        Tekstove\Chat::newMessageSystemStatic('следите ли ни в [url=https://twitter.com/#!/tekstoveinfo]twitter[/url]');
        break;
    case 1:
        Tekstove\Chat::newMessageSystemStatic('следите ли ни в [url=http://www.facebook.com/pages/%D1%82%D0%B5%D0%BA%D1%81%D1%82%D0%BE%D0%B2%D0%B5%D0%B8%D0%BD%D1%84%D0%BE/121306641245195]facebook[/url]');
        break;
    case 2:
        Tekstove\Chat::newMessageSystemStatic('![b]help[/b] за лист с командите');
        break;
    default:
        break;
}