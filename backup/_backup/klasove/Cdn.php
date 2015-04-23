<?php

/**
 * Description of Cdn
 *
 * @author potaka
 */
class Cdn {

	const APC_GOOGLE = 'APC_CDN_GOOGLE_STATUS';

	/**
	 * in seconds. 60 = minute. 3600 = hour
	 */
	const CACHE_TIMEOUT = 1800;

	public static $useGoogleCdn = null;

	protected static function useGoogleCdn() {
		$apcCache = Tekstove\Cache::get(self::APC_GOOGLE);
		if ($apcCache !== false) {
			return $apcCache;
		}

		$ch = curl_init('http://www.google.com/jsapi');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);

		$result = curl_exec($ch);
		curl_close($ch);
		if ($result === false) {
			\Tekstove\Cache::set(self::APC_GOOGLE, 0, self::CACHE_TIMEOUT);
		} else {
			\Tekstove\Cache::set(self::APC_GOOGLE, 1, self::CACHE_TIMEOUT);
		}
		return $result;
	}

    /**
     * 
     * @return string
     */
	public static function getJsCode() {
		if (self::useGoogleCdn()) {
			return '
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/'.SITE_JS_JQUERY_VERSION.'/jquery.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/' . SITE_JS_JQUERY_UI_VERSION . '/jquery-ui.min.js"></script>
				';
		} else {
			return '
				<script src="/js/jquery-' . SITE_JS_JQUERY_VERSION . '.min.js" type="text/javascript"></script>
				<script src="/js/jquery-ui-' . SITE_JS_JQUERY_UI_VERSION . '.custom.min.js" type="text/javascript"></script>
				
				';
		}
	}

}
