<?php

/**
 * Description of LyricTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \Tekstove\LyricException
	 * @expectedExceptionCode 404
	 */
	public function testLyricConstructorFromInteger() {
		$lyric = new lyric(-5);
	}
	
	public function testLyricConstructorFromArray() {
		$pdo = PDOX::singleton();
		$stm = $pdo->prepare("
			SELECT
				*
			FROM
				lyric
			LIMIT 
				1
		");
		$stm -> execute();
		$lyricData = $stm->fetch();
		$lyric = new lyric($lyricData);
	}

}
