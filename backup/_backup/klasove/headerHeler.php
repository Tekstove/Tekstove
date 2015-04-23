<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of headerHeler
 *
 * @author potaka
 */
class headerHeler {
	public static function notFound(){
		header("HTTP/1.0 404 Not Found");
		header("Status: 404 Not Found");
	}
	
	public static function pernamentRedirect($link) {
		header("Location: " . $link, TRUE, 301);
		die;
	}
	
	public static function internalServerError() {
		header('HTTP/1.1 500 Internal Server Error');
	}
	
	public static function forbidden(){
		header('HTTP/1.1 403 Forbidden');
	}
	
	public static function unauthorized(){
		header('HTTP/1.1 401 Unauthorized');
	}
	
	public static function badReqest(){
		header('HTTP/1.1 400 Bad Request');
	}
	
	public static function gone() {
		header('HTTP/1.1 410 Gone');
	}
}