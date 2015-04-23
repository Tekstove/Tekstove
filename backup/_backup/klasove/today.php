<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of today
 *
 * @author po_taka
 */
class today
{

	private static $ApcUpdateInterval = 3600;
	private static $ApcKey = 'APC_today_today';

	public static function getTodayOne($returnArray = false)
	{
		$todayData = \Tekstove\Cache::get(self::$ApcKey);
		
		if ($todayData === NULL) {
			return false;
		}
		
		if ($todayData === false) {

			$pdo = PDOX::singleton();
			$stm = $pdo->prepare("
				SELECT
					*
				FROM
					`today`
				WHERE
					`date` LIKE(
								DATE_FORMAT(CURDATE(), '____-%m-%d')
								)
				ORDER
					BY RAND()
				");
			$stm->execute();
			if ($stm->rowCount() > 0) {

				$dataForCache = array();
				foreach ($stm->fetchAll() as $data) {
					$dataText = preg_replace('/{date}/', mb_substr($data['date'], 0, 4), $data['text']);
					
					$dataForCache[] = array(
						'text' => htmlspecialcharsX($dataText),
						'artist_id' => $data['artist_id']
					);

				}
				
				$todayData = $dataForCache;
				\Tekstove\Cache::set(self::$ApcKey, $dataForCache, self::$ApcUpdateInterval);
				
			}
			else {
				Tekstove\Cache::set(self::$ApcKey, NULL, self::$ApcUpdateInterval);
				return FALSE;
			}
		}

		$return = $todayData[array_rand($todayData)];
		return $return;
	}

    /**
     * 
     * @param bool $bbcode
     * @return string|boolean
     */
	public static function getTodayOneHtml($bbcode = false)
	{
		$data = self::getTodayOne();
		if ($data === false) {
			return false;
		}

		$returnData = $data['text'];

		if ($data['artist_id'] !== NULL) {
			if ($bbcode) {
				$returnData = '[url=http://tekstove.info/browsepoartist.php?id=' . $data['artist_id'] . ']' . $returnData . '[/url]';
			}
			else {
				$returnData = '<a href="/browsepoartist.php?id=' . $data['artist_id'] . '">' . $returnData . '</a>';
			}
		}

		return $returnData;
	}

}
