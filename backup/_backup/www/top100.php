<?php
Require ("__top.php");
try{
$mqsto=1;

if (isset($_GET['kakvo'])) {
	$kakvo = $_GET['kakvo'];
} else {
	$kakvo = NULL;
}

	switch ($kakvo) {
	case 'glasove':
		headerHeler::pernamentRedirect('/top100.php?kakvo=glasa');
		break;
	default:
		break;
}

if ($kakvo == "glasa" || $kakvo == "vidqna" || $kakvo == "populqrnost" || $kakvo == "posledno_glasuvani") {


switch ($kakvo) {
    case 'glasa':
        $kakvo_ime='Гласа';
        $stm = $pdo -> prepare ("SELECT `id`,`zaglavie_sakrateno`, `glasa` AS `kakvo` FROM `lyric` ORDER BY `glasa` DESC LIMIT 100");

        break;

    case 'populqrnost':
        $kakvo_ime = 'Популярност';
        $stm = $pdo->prepare ("SELECT `id`,`zaglavie_sakrateno`, `populqrnost` AS `kakvo` FROM `lyric` ORDER BY `populqrnost` DESC LIMIT 100");
        break;

    case 'vidqna':
    $kakvo_ime = 'Видяна';
    $stm = $pdo->prepare ("SELECT `id`,`zaglavie_sakrateno`, `vidqna` AS `kakvo` FROM `lyric` ORDER BY `vidqna` DESC LIMIT 100");
    break;

    case 'posledno_glasuvani':
    $kakvo_ime = '';
    $stm = $pdo->prepare ("SELECT `lyric`.`id`, `lyric`.`zaglavie_sakrateno`, '' AS `kakvo`
	FROM `glasuvane` LEFT JOIN `lyric`
	ON `glasuvane`.`za`=`lyric`.`id`
        ORDER BY `glasuvane`.`id` DESC LIMIT 100
        ");
    break;

    default:
        greshka('дефаут в суича');
}


$stm -> execute();
foreach ($stm->fetchAll() as $v) {
$pesni[] = array(
    'id' => $v['id'],
    'kakvo' => $v['kakvo'],
    'zaglavie' => htmlspecialchars($v['zaglavie_sakrateno'])
);
}
unset ($v);


}

else {
    greshka('не е посочена категория','не е посочена категория');
}


}
catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "top100.php");
?>