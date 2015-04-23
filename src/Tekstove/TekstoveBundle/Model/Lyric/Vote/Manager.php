<?php

namespace Tekstove\TekstoveBundle\Model\Lyric\Vote;

/**
 * Description of Manager
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Manager extends \Tekstove\TekstoveBundle\Model\Manager
{
    public function getBy(array $optionsParams) {
        $defaultOptions = [
            'order' => 'id',
            'orderType' => 'DESC',
            'limit' => 10,
        ];
        
        $sqlWhere = '';
        
        $options = array_merge($defaultOptions, $optionsParams);
        
        $queryStr = "
            SELECT
                *
            FROM
                `glasuvane`
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
        while ($voteData = $lyricsDataStm->fetch()) {
            $return[] = new \Tekstove\TekstoveBundle\Model\Lyric\Vote($voteData);
        }

        return $return;
    }
}
