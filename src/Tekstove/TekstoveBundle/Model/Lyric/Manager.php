<?php

namespace Tekstove\TekstoveBundle\Model\Lyric;

use Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of Manager
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Manager extends \Tekstove\TekstoveBundle\Model\Manager
{

    public function addEventSubscribers() {
        $ed = $this->getEventDispatcher();
        $ed->addSubscriber(new \Tekstove\TekstoveBundle\Model\Lyric\Event\Subscriber\Retrieve());
    }

    /**
     * 
     * @param type $id
     * @return \Tekstove\TekstoveBundle\Model\Lyric
     * @throws \Exception
     */
    public function getById($id) {
        $dataStm = $this->db->prepare("
            SELECT
                *
            FROM
                `lyric`
            WHERE
                id = :id
        ");
        $dataStm->bindValue('id', $id, \PDO::PARAM_INT);
        $dataStm->execute();

        if ($dataStm->rowCount() === 0) {
            // @TODO throw specific exp
            throw new \Exception('Lyric not found');
        }

        $lyricsData = $dataStm->fetch();
        $return = new \Tekstove\TekstoveBundle\Model\Lyric($lyricsData, $this);
        $event = new Event\Retrieve($return);
        $this->getEventDispatcher()->dispatch(Events::RETRIEVE, $event);
        
        return $return;
    }

    
    public function getBy(array $optionsParams) {
        $defaultOptions = [
            'order' => 'id',
            'orderType' => 'DESC',
            'limit' => 10,
        ];
        
        $sqlWhere = '';
        
        $options = array_merge($defaultOptions, $optionsParams);
        
        if (!empty($options['onlyTranslated'])) {
            $sqlWhere .= " AND `text_bg` LIKE ('%_%')";
        }
        
        if (isset($options['ids'])) {
            if (empty($options['ids'])) {
                return [];
            }
            
            array_walk($options['ids'], function(&$id) {
                // @TODO better check if is int
                $id = (int) $id;
                return $id;
            });
            
            $sqlWhere .= " AND `id` IN (" . implode(',', $options['ids']) . ")";
            
        }
        
        $queryStr = "
            SELECT
                *
            FROM
                `lyric`
            WHERE
                1
                {$sqlWhere}
            ORDER BY
                :order :orderType
            LIMIT
                :limit
        ";
        
        $queryParsed = $this->bindCustom($queryStr, $options);
        
        $lyricsDataStm = $this->db->prepare($queryParsed);
        $lyricsDataStm->bindValue('limit', $options['limit'], \PDO::PARAM_INT);
        $lyricsDataStm->execute();

        $return = [];
        while ($lyricData = $lyricsDataStm->fetch()) {
            $lyric = new \Tekstove\TekstoveBundle\Model\Lyric($lyricData, $this);
            $retrieveEvent = new Event\Retrieve($lyric);
            $this->getEventDispatcher()->dispatch(Events::RETRIEVE, $retrieveEvent);
            $return[] = $lyric;
        }

        return $return;
    }

    public function getArtist($id) {
        $artist = $this->getArtistManager()
                                ->getById($id);

        return $artist;
    }
    
    public function getLanguage($id) {
        return $this->getLanguageManager()->getById($id);
    }

    public static function getRandomLyric() {

        $pdo = PDOX::singleton();

        $maxId = Tekstove\Cache::get(CACHE_LYRIC_MAX_ID);

        if (!$maxId) {
            if (self::$lyricIdmax == NULL) {

                $stm = $pdo->prepare('SELECT MAX(`id`) FROM `lyric`');
                $stm->execute();
                $data = $stm->fetch();
                $maxId = $data[0];

                Tekstove\Cache::set(CACHE_LYRIC_MAX_ID, $maxId, 72000); // 20 часа
            }
        }

        $id = rand(0, $maxId);
        $stm = $pdo->prepare('SELECT * FROM `lyric` WHERE `id` >= ? LIMIT 1');
        $stm->bindValue(1, $id, PDO::PARAM_INT);
        $stm->execute();

        $dataLyric = $stm->fetch();

        $lyric = new lyric($dataLyric);

        return $lyric;
    }

    /**
     * 
     * @return \lyric
     */
    public function updateCache() {
        $cacheFull = '';
        $cacheShort = '';

        for ($q = 1; $q <= 5; $q++) {
            if ($this->{'artist' . $q}) {
                $artistTemp = new \Tekstove\Artist\Artist($this->{'artist' . $q});
                $artistTempCache = $artistTemp->getName(false);
                if ($artistTemp->getNameAlternatives()) {
                    $artistTempCache .= ' ' . $artistTemp->getNameAlternatives();
                }

                if ($q == 1) {
                    $cacheShort .= $artistTemp->getName(false);
                } elseif ($q == 2) {
                    $cacheShort .= ' и ' . $artistTemp->getName(false);
                }

                $cacheFull .= $artistTempCache;
            }
        }

        $cacheShort .= ' - ' . $this->getTitle(false);
        $cacheFull .= $this->getTitle(false);
        $cacheFull = preg_replace('/ /m', '', $cacheFull);

        $pdo = PDOX::singleton();
        $stm = $pdo->prepare("
			UPDATE
				`lyric`
			SET
				`zaglavie_sakrateno` = :cacheShort,
				`zaglavie_palno` = :cacheFull
			WHERE
				id = :id
		");
        $stm->bindValue('cacheShort', $cacheShort);
        $stm->bindValue('cacheFull', $cacheFull);
        $stm->bindValue('id', $this->getId(), PDO::PARAM_INT);

        $stm->execute();

        return $this;
    }

    public function increaseViews() {
        $pdo = PDOX::singleton();
        $stm = $pdo->prepare('INSERT INTO `lyric_views`(`lyric_id`, `ip`) VALUES(?, ?) ');
        $stm->bindValue(1, $this->getId(), PDO::PARAM_INT);
        $stm->bindValue(2, ip2long($_SERVER['REMOTE_ADDR']));
        $stm->execute();
    }

    public function getByArtist($artistId) {
        
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                `lyric`
            WHERE
                artist1 = :artist
                OR artist2 = :artist
                OR artist3 = :artist
                OR artist4 = :artist
                OR artist5 = :artist
            ORDER BY
                title
        ");
        
        $stm->bindValue('artist', $artistId, \PDO::PARAM_INT);
        $stm->execute();
        $return = [];
        foreach ($stm->fetchAll() as $data) {
            $return[] = new Lyric($data, $this);
        }
        
        return $return;
        
    }

    /**
     * 
     * @param Lyric $l
     * @return Lyric
     */
    public function save(Lyric $l) {
        
        
        if (null === $l->getId()) {
            $process = ' INSERT INTO ';
            $where = '';
        } else {
            $process = ' UPDATE ';
            $where = 'WHERE id = :id ';
        }
        
        $stm = $this->db->prepare("
            {$process}
                `lyric`
            SET
                id = :id,
                text = :text,
                title = :title
            {$where}
        ");
            
        $stm->bindValue(':id', $l->getId());
        $stm->bindValue(':text', $l->getText(), \PDO::PARAM_STR);
        $stm->bindValue(':title', $l->getTitle(), \PDO::PARAM_STR);
        
        $stm->execute();
        
        if ($l->getId()) {
            $return = $this->getById($l->getId());
        } else {
            $return = $this->getById($this->db->lastInsertId());
        }
        
        return $return;
        
    }

}
