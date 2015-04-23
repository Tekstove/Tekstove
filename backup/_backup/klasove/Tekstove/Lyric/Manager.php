<?php

namespace Tekstove\Lyric;

use \PDO;
/**
 * Description of Manager
 *
 * @author po_taka
 */
class Manager {

	public function deleteDoubled(\lyric $original, \lyric $doubled) {

		if ($original->getId() >= $doubled->getId()) {
			throw new \Tekstove\LyricValidationException('грешка: трябва да се изтрие по-новата песен (с по-голямо ID)');
		}
		
		$pdo = \PDOX::singleton();
		
		$pdo->beginTransaction();

		$stm = $pdo->prepare("
				INSERT INTO `lyric-iztriti` (`id_ztril`, `lyric_id`, `prichina`, `zaglavie_palno`, `zaglavie_sakrateno`, `up_id`, `text`, `text_bg`, `title`, `album1`, `album2`, `video`, `video_vbox7`, `video_youtube`, `video_metacafe`, `image`, `ip_upload`, `dopylnitelnoinfo`, `glasa`, `vidqna`, `populqrnost`)
					SELECT :id_iztril, id, :prichina, `zaglavie_palno`, `zaglavie_sakrateno`, `up_id`, `text`, `text_bg`, `title`, `album1`, `album2`, `video`, `video_vbox7`, `video_youtube`, `video_metacafe`, `image`, `ip_upload`, `dopylnitelnoinfo`, `glasa`, `vidqna`, `populqrnost` FROM `lyric` WHERE `id` = :id
			");
		$deleteReason = 'повтаря се [url=http://tekstove.info/browse.php?id=' . $original->getId() . ']ttp://tekstove.info/browse.php?id=' . $original->getId() . '[/url]';
		
		$stm->bindValue(':id', $doubled->getId(), PDO::PARAM_INT);
		$stm->bindValue(':prichina', $deleteReason, PDO::PARAM_STR);
		$stm->bindValue(':id_iztril', \currentUser::getInstance()->getId(), PDO::PARAM_INT);
		$stm->execute();

		$pesen_backup_id = $pdo->lastInsertId();

		$stm = $pdo->prepare('INSERT INTO `comments-iztriti` (`text`, `sendby`, `date`, `date_orig`, `edited`, `zakoqpesen`)
				SELECT                                            `text`, `sendby`, `date`, `date_orig`, `edited`, :pesen_backup_id FROM `comments` WHERE `zakoqpesen` = :pesen_id ORDER BY `id` ');
		$stm->bindValue(':pesen_id', $doubled->getId(), PDO::PARAM_INT);
		$stm->bindValue(':pesen_backup_id', $pesen_backup_id, PDO::PARAM_INT);
		$stm->execute();



		if ($doubled->getUp_id()) {
			$stm = $pdo->prepare('
					INSERT INTO `pm` ( `za`, `ot`, `text`, `otnosno`)
					VALUES ( :za, :iztril_pesenta_id , :text, :otnosno)');
			$stm->bindValue(':za', $doubled->getUp_id(), PDO::PARAM_INT);
			$stm->bindValue(':text', 'Песента [b]' . $doubled->get_Zaglavie_sakrateno(1) . '[/b] бе изтрита' . PHP_EOL . PHP_EOL . 'причина: ' . PHP_EOL . $deleteReason, PDO::PARAM_STR);
			$stm->bindValue(':otnosno', 'Изтрита песен', PDO::PARAM_STR);
			$stm->bindValue(':iztril_pesenta_id', \currentUser::getInstance()->getId(), PDO::PARAM_INT);
			$stm->execute();
		}



		$stm = $pdo->prepare("DELETE FROM `lyric` WHERE `id` = ? ");
		$stm->bindValue(1, $doubled->getId(), PDO::PARAM_INT);
		$stm->execute();

		$pdo->commit();
	}

}
