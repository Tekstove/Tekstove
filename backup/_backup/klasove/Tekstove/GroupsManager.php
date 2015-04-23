<?php

namespace Tekstove;

use PDOX;

/**
 * Description of GroupManager
 *
 * @author po_taka
 */
class GroupsManager
{

    /**
     * 
     * @return \Tekstove\Acl\Group
     */
    public function getGroups()
    {
        $pdo = PDOX::singleton();
        $stm = $pdo->prepare("
            SELECT
                *
            FROM
                permission_groups
            ORDER BY
                id
        ");

        $stm->execute();

        $return = [];
        foreach ($stm->fetchAll() as $data) {
            $return[] = new Acl\Group($data);
        }

        return $return;
    }

}
