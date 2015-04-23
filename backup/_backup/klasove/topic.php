<?php

/**
 * Description of forum
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class topic {
	
	private $id;
	private $pdo;
	
	function __construct($id)
    {
        $this->pdo = PDOX::singleton();
        $this->id = $id;
    }

    public function addWatcher($userId)
    {

        $stm = $this->pdo->prepare("
			INSERT IGNORE INTO `forum_topic_watchers`(`user_id`, `forum_topic_id`)
			VALUES (:userId, :forumTopicId)");
        $stm->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stm->bindValue(':forumTopicId', $this->getId(), PDO::PARAM_INT);
        $stm->execute();
    }

    public function informWatchers()
    {

        $stm = $this->pdo->prepare("
			INSERT INTO `pm` (`za`, `ot`,`text`,`otnosno`)
			VALUES (:za, :ot, :text, :otnosno)
		");
		
		foreach ($this->getWatchers() as $w) {
		
		$stm->bindValue(':za', $w['user_id'], PDO::PARAM_INT);
		
		/** @todo hardcoded id */
		$stm->bindValue(':ot', 54, PDO::PARAM_INT);
		$stm->bindValue(':text', 'Ново мнение в [url=http://tekstove.info/forum_topic_vij.php?id='.$this->getId().']тема, линк http://tekstove.info/forum_topic_vij.php?id='.$this->getId().'[/url]');
		$stm->bindValue(':otnosno', 'Ново мнение в тема');
		$stm->execute();
		}
		
	}

    /**
     * 
     * @return array
     */
	public function getWatchers()
    {
        $stm = $this->pdo->prepare("
			SELECT
				*
			FROM
				`forum_topic_watchers`
			WHERE
				forum_topic_id = :topicId
        ");
		$stm->bindValue(':topicId', $this->getId(), PDO::PARAM_INT);
		$stm->execute();
		$data = $stm->fetchAll();
		return $data;
	}


		public function getId() {
		return $this->id;
	}

}
