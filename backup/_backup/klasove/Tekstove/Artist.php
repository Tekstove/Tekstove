<?php

namespace Tekstove;

use PDO;

/**
 * Description of Artist
 *
 * @author potaka
 */
class Artist
{

    private $id;
    private $name;
    private $forbidden;

    function __construct($data)
    {
        if (is_int($data)) {
            $pdo = \PDOX::singleton();
            $stm = $pdo->prepare("
                SELECT
                    *
                FROM
                    artists
                WHERE
                    id = ?
            ");
            $stm->bindValue(1, $data, PDO::PARAM_INT);
            $stm->execute();
            if ($stm->rowCount() == 0) {
                throw new Exception('artist not found');
            }

            $artistData = $stm->fetch();
            $this->id = $artistData['id'];
            $this->name = $artistData['name'];
            $this->forbidden = (bool) $artistData['forbidden'];
        } else {
            throw new \Exception('wrong type for constructor');
        }
    }

    public function getForbidden()
    {
        return $this->forbidden;
    }

}
