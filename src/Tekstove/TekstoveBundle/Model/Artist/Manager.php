<?php

namespace Tekstove\TekstoveBundle\Model\Artist;

use Tekstove\TekstoveBundle\Model\Artist;

/**
 * Description of Manager
 *
 * @author potaka
 */
class Manager extends \Tekstove\TekstoveBundle\Model\Manager
{

    public function getById($id)
    {
        $id = (int) $id;
        $dataStm = $this->db
                ->prepare("
            SELECT
                *
            FROM
                `artists`
            WHERE
                id = :id
        ");
        $dataStm->bindValue('id', $id, \PDO::PARAM_INT);
        $dataStm->execute();

        if ($dataStm->rowCount() === 0) {
            // @TODO throw specific exp
            throw new \Exception('lyrc not found');
        }

        $data = $dataStm->fetch();
        $return = new \Tekstove\TekstoveBundle\Model\Artist($data);

        return $return;
    }
    
    public function findByStartWith($letter)
    {
        $pdo = $this->db;

        if ($letter === '-') {
            $stm = $pdo->prepare("
                SELECT
                    *
                FROM
                    artists
                WHERE
                    `name` NOT REGEXP \"^[0-9a-zA-Zа-яА-Я]\"
            ");
        } else {
            $stm = $pdo->prepare("
                SELECT
                    *
                FROM
                    artists
                WHERE
                    name LIKE :letter
            ");

            $stm->bindValue('letter', $letter . '%');
        }
        
        
        $stm->execute();
        
        $return = [];
        foreach ($stm->fetchAll() as $data) {
            $return[] = new Artist($data, $this);
        }
        
        return $return;
    }

}
