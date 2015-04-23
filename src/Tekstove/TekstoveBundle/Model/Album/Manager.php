<?php

namespace Tekstove\TekstoveBundle\Model\Album;

/**
 * Description of Manager
 *
 * @author potaka
 */
class Manager extends \Tekstove\TekstoveBundle\Model\Manager
{

    private $artistManager;

    function __construct(\Tekstove\TekstoveBundle\Model\Db\DbInterface $db, \Tekstove\TekstoveBundle\Model\Artist\Manager $artistManager)
    {
        $this->artistManager = $artistManager;
        return parent::__construct($db);
    }

    public function getLatest($limit)
    {
        $pdo = $this->db;
        $stm = $pdo->prepare("
            SELECT
                *
            FROM
                `albums`
            ORDER BY
                id DESC
            LIMIT
                :limit
        ");

        $stm->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stm->execute();

        $return = [];
        foreach ($stm->fetchAll() as $data) {
            $return[] = new \Tekstove\TekstoveBundle\Model\Album($data, $this);
        }

        return $return;
    }

    public function getArtist($id)
    {
        return $this->artistManager
                            ->getById($id);
    }

}
