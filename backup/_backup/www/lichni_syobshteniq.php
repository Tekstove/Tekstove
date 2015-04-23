<?php
Require ("__top.php");

potrebitel::zadaljitelno_lognat($username_id);

if (isset ($_GET['vij_izhodqshti'])) {

    $stm = $pdo->prepare("
		SELECT
			`id`,
			`za`,
			`otnosno`,
			`data`,
			`procheteno`
		FROM
			`pm`
		WHERE
			`ot` = ?
		ORDER BY
			id DESC
		LIMIT
			200
		");
    $stm -> bindValue(1, $username_id, PDO::PARAM_INT);
    $stm -> execute();
        foreach ($stm->fetchAll() as $v){
            $saobshteniq[] = array(
                'ot' => $v['za'],
                'ot_ime' => potrebitel::ime_ot_id($v['za']),
                'data'   => $v['data'],
            'procheteno' => $v['procheteno'],
            'id'     => $v['id'],
            'otnosno' => htmlspecialchars($v['otnosno'])
                );
            }
} else {

    if (isset ($_GET['all'])) {
        $stm = $pdo->prepare("SELECT `id`, `ot`, `otnosno`, `data`, `procheteno` FROM `pm` WHERE `za` = ? ORDER BY `id` DESC");
    }
    else {
        $stm = $pdo->prepare("
            SELECT
                `id`, `ot`, `otnosno`, `data`, `procheteno`
            FROM
                `pm`
            WHERE
                `za` = ?
            ORDER BY
                `procheteno`,
                `id` DESC
            LIMIT
                10
        ");
    }
    $stm->bindValue(1, $username_id, PDO::PARAM_INT);
    $stm->execute();
    foreach ($stm->fetchAll() as $v) {

            $saobshteniq[] = array(
            'ot'     => $v['ot'],
            'ot_ime' => potrebitel::ime_ot_id($v['ot']),
            'data'   => $v['data'],
            'procheteno' => $v['procheteno'],
            'id'     => $v['id'],
            'otnosno' => htmlspecialchars($v['otnosno'])
            );

    }
}




Require (SITE_PATH_TEMPLATE . "lichni_syobshteniq.php");
