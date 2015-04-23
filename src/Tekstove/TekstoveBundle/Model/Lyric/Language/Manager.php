<?php

namespace Tekstove\TekstoveBundle\Model\Lyric\Language;

/**
 * Description of Manager
 *
 * @author potaka
 */
class Manager extends \Tekstove\TekstoveBundle\Model\Manager
{

    public function getById($id)
    {
        $stm = $this->db->prepare("
            SELECT
                *
            FROM
                languages
            WHERE
                id = ?
        ");
        
        $stm->bindValue(1, $id);
        $stm->execute();
        if ($stm->rowCount() !== 1) {
            throw new \Exception('can\'t find language');
        }
        $data = $stm->fetch();
        return new \Tekstove\TekstoveBundle\Model\Lyric\Language($data);
    }

}
