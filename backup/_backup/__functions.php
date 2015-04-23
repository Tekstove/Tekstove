<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */

mb_internal_encoding("UTF-8");

define('CACHE_LYRIC_TOP_10_VIEWS', 'APC_TOP_10_VIEWS');
define('CACHE_LYRIC_FAVOURITES_RANDOM_10', 'APC_RANDOM_10_LIUBIMI');
define('CACHE_ALBUM_LAST_10', 'APC_LAST_10_ALBUMS');
define('CACHE_LYRIC_STATS', 'APC_STATS');
define('CACHE_LYRIC_MAX_ID', 'APC_LYRIC_MAX_ID');

/**
 *
 * @param type $text
 * @return false|string
 */
function spamCheck($text) {
	
	$data = array(
		'4chan.com',
		'4chan.org',
		'dagay.com',
		'neoliquid.com',
		'nobrain.dk',
		'pornhub.com',
		'xxgifs.com',
	);
	
	
	foreach ($data as $d) {
		$dEscaped = preg_quote($d, '|');
		if (preg_match('|' . $dEscaped . '|i', $text)) {
			return $d;
		}
	}
    
    return false;
    
}

/**
 * @return true if cenzor should be applied
 * @return false if cenzor shouldn't be applied
 * @param string $text
 */
function cenzor($text) {
	// @todo "цензора." не мачва

	$cenzora = array();

	$cenzora[] = '[dе]?[eе][bб][eеaаiи]';
	$cenzora[] = '[eе][bб][eе][tт][eеiи]+';
	$cenzora[] = '[pп][eе][dд][eе][rр][aа][zзsс]+[iиtт]*';
	$cenzora[] = '[kк][uу][rр][vwв][aаiи]+';
	$cenzora[] = '[kк][uу][rр][aа]*';
	$cenzora[] = '[pп][uу][tт][kк][aаiи]';

	foreach ($cenzora as $v) {
		if (preg_match('/(^|\s)' . $v . '(\s|$)/imu', $text)) {
			return true;
		}
	}
	
	return false;
}

/**
 * @return true if cenzor should be applied
 * @return false if cenzor shouldn't be applied
 * @param string $text
 */
function cenzorSuspicious($text) {
	$cenzora = array();

	$cenzora[] = 'tumblr\\.com';
	$cenzora[] = '[дd]?[eе][bб][eеaаiи]';
	$cenzora[] = '[гg][еe][ийяаaiq]';
	$cenzora[] = '[eе][bб][eе][tт][eеiи]+';
	$cenzora[] = '[иi][дd][иi][оo][тt]';
	$cenzora[] = '[pп][eе][dд][eеaа][rрлl]';
	$cenzora[] = '[kк][uу][rр][vwв][aаiи]+';
	$cenzora[] = '[kк][uу][rр][aа]*';
	$cenzora[] = '[pп][uу][tт][kк][aаiи]';
	$cenzora[] = '[хh][uу][яqаaийi]';

	foreach ($cenzora as $v) {
		if (preg_match('/' . $v . '/imu', $text)) {
			return true;
		}
	}
	
	return false;
}


function skype_code($skypename, $kod=0)
{

	if (!$skypename)
		return;

	$skypename = htmlspecialcharsX($skypename);

	if ($kod == 1) { //width="114" height="20"
		return '<a href="skype:' . $skypename . '?chat"><img src="http://mystatus.skype.com/smallclassic/' . $skypename . '" style="border: none;" width="114" height="20" alt="My status" /></a>
    ';
	}


//width="16" height="16"
	return '<a href="skype:' . $skypename . '?chat"><img src="http://mystatus.skype.com/smallicon/' . $skypename . '" style="border: none;" width="16" height="16" alt="My status" /></a>';
}

function bbcode_format($str)
{

	return $str;


	$simple_search = array(
		'/\[b\](.*?)\[\/b\]/is',
		'/\[i\](.*?)\[\/i\]/is',
		'/\[u\](.*?)\[\/u\]/is',
		'/\[url\=([абвгдежзийклмнопрстуфхцчшщъьюяАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯa-zA-Z0-9#\:\=\_\-\?\&\;\%\/\.\?\+\(\)]+)\](.*?)\[\/url\]/is',
		'/\[img\]([абвгдежзийклмнопрстуфхцчшщъьюяАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯa-zA-Z0-9#\:\=\_\-\?\&\;\%\/\.\?\+\(\)]+)\[\/img\]/is',
		'/:\)/is',
		'/(\(:P\)|(\s|\n|\<br\>|^):P(\s|\n|\<br\>|$))/is',
		'/\(kitara\)/is',
		'/\(dance\)/is',
		'/\(svirq\)/is',
		'/\(party\)/is',
		'/\(ogan4e\)/is',
		'/\(rock\)/is',
		'/\(slu6alki\)/is',
		'/\(skasetofon\)/is',
		'/\(\?\)/is',
		'/\(dance2\)/is',
		'/\(dance3\)/is',
		'/\(barabani\)/is',
		'/\(arfa\)/is',
		'/\(radost\)/is',
		'/\(peq\)/is',
		'/\(dance4\)/is',
		'#(\s|\n|\<br\>|^):\*(\s|\n|\<br\>|$)#isu',
		'#(\s|\n|\<br\>|^):D(\s|\n|\<br\>|$)#isu',
		'#\(hug\)#isu'
	);

	$simple_replace = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<u>$1</u>',
		'<a href="$1" target="_blanc"><u>$2</u></a>',
		'<img src="$1">',
		'<img src="emic/1.gif">',
		'<img src="emic/12.gif">',
		'<img src="emic/2.gif">',
		'<img src="emic/3.gif">',
		'<img src="emic/4.gif">',
		'<img src="emic/5.gif">',
		'<img src="emic/7.gif">',
		'<img src="emic/8.gif">',
		'<img src="emic/9.gif">',
		'<img src="emic/10.gif">',
		'<img src="emic/11.gif">',
		'<img src="emic/13.gif">',
		'<img src="emic/14.gif">',
		'<img src="emic/15.gif">',
		'<img src="emic/16.gif">',
		'<img src="emic/17.gif">',
		'<img src="emic/18.gif">',
		'<img src="emic/19.gif">',
		'$1<img src="emic/20.gif">$2',
		'$1<img src="emic/21.gif">$2',
		'$1<img src="emic/22.gif">$2'
	);





	// Прости BBCode тагове
	$strnew = preg_replace($simple_search, $simple_replace, $str);
	if ($strnew == $str)
		return $str;
	else
		return (bbcode_format($strnew));
}
