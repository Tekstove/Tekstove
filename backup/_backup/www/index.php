<?php

require"__top.php";

/* @var $pdo pdo */
/* @var $stm PDOStatement */

\Tekstove\Registry::getInstance()->setAdsense(TRUE);

$pesni_posledni = NULL;
$query = $pdo->query('SELECT `id`, `zaglavie_sakrateno` FROM `lyric`  ORDER BY `id` DESC LIMIT 10');
foreach ($query as $row) {
    $pesni_posledni[] = array(
        'id' => $row['id'],
        'title' => htmlspecialchars($row['zaglavie_sakrateno']),
        'text' => sakrati($row['zaglavie_sakrateno'], 43)
    );
}



$pesni_prevedeni = NULL;
$stm = $pdo->query("SELECT `id`,`zaglavie_sakrateno` FROM `lyric`  WHERE `text_bg` LIKE ('%_%') ORDER BY `podnovena` DESC LIMIT 10");
foreach ($stm as $row) {
    $pesni_prevedeni[] = array(
        'id' => $row['id'],
        'title' => htmlspecialchars($row['zaglavie_sakrateno']),
        'text' => sakrati($row['zaglavie_sakrateno'], 43)
    );
}



$pesni_populqrni = Tekstove\Cache::get('index_populqrni');
if ($pesni_populqrni === false) {
    $query = $pdo->query("SELECT `id`, `zaglavie_sakrateno` FROM `lyric` ORDER BY `populqrnost` DESC LIMIT 10");
    foreach ($query as $row) {

        $pesni_populqrni[] = array(
            'id' => $row['id'],
            'title' => htmlspecialcharsX($row['zaglavie_sakrateno']),
            'text' => sakrati($row['zaglavie_sakrateno'], 43)
        );
    }

    \Tekstove\Cache::set('index_populqrni', $pesni_populqrni, 1200);
}



$pesni_gledani = Tekstove\Cache::get(CACHE_LYRIC_TOP_10_VIEWS);
if ($pesni_gledani === false) {

    $stm = $pdo->prepare('SELECT `id`, `zaglavie_sakrateno` FROM `lyric` ORDER BY `vidqna` DESC LIMIT 10');
    $stm->execute();
    foreach ($stm->fetchAll() as $v) {
        $pesni_gledani[] = array(
            'id' => $v['id'],
            'title' => htmlspecialcharsX($v['zaglavie_sakrateno']),
            'text' => sakrati($v['zaglavie_sakrateno'], 43)
        );
    }

    Tekstove\Cache::set(CACHE_LYRIC_TOP_10_VIEWS, $pesni_gledani, 1200);
}



$pesni_glasuvani_posledn = NULL;
$stm = $pdo->query("SELECT `lyric`.`id`, `lyric`.`zaglavie_sakrateno`
FROM `glasuvane` LEFT JOIN `lyric`
ON `glasuvane`.`za`=`lyric`.`id`
    ORDER BY `glasuvane`.`id` DESC LIMIT 10");

foreach ($stm->fetchAll() as $v) {

    $pesni_glasuvani_posledn[] = array(
        'id' => $v['id'],
        'title' => htmlspecialcharsX($v['zaglavie_sakrateno']),
        'text' => sakrati($v['zaglavie_sakrateno'], 43)
    );
}


$pesni_liubimi = \Tekstove\Cache::get(CACHE_LYRIC_FAVOURITES_RANDOM_10);

if ($pesni_liubimi === false) {
    // for performance
    $stm = $pdo->prepare('SELECT `id`, `zaglavie_sakrateno` FROM `lyric` WHERE `id`= ? LIMIT 1');

    $query_l_p = $pdo->query("SELECT `pesen` FROM `liubimi` ORDER BY RAND() LIMIT 10");
    foreach ($query_l_p as $row_l_p) {

        $stm->bindValue(1, $row_l_p['pesen'], PDO::PARAM_INT);
        $stm->execute();

        $row = $stm->fetch();

        $pesni_liubimi[] = array(
            'id' => $row['id'],
            'title' => htmlspecialchars($row['zaglavie_sakrateno']),
            'text' => sakrati($row['zaglavie_sakrateno'], 43)
        );
    }
    \Tekstove\Cache::set(CACHE_LYRIC_FAVOURITES_RANDOM_10, $pesni_liubimi, 1200);
    unset($stm, $row);
}

$albumi = \Tekstove\Cache::get(CACHE_ALBUM_LAST_10);
if ($albumi === false) {
    $query = $pdo->query("SELECT `id`, `name`, `artist1id`, `artist2id`, `year`, `image`  FROM `albums` ORDER BY `id` DESC LIMIT 4");
    $albumi = NULL;
    foreach ($query as $row) {
        $t['id'] = $row['id'];

        $artist_name_album = lyric::artist_name_ot_id($row['artist1id'], 1);
        if ($row['artist2id']) {
            $artist_name_album .= " и " . lyric::artist_name_ot_id($row['artist2id'], 1);
        }

        $t['title'] = htmlspecialcharsX($artist_name_album . " - " . $row['name']);


        $t['text'] = sakrati($artist_name_album, 19);

        $t['text'] .= "<br>";

        $t['text'] .= sakrati($row['name'], 19);

        $t['text'] .= "<br>";
        if ($row['year']) {
            $t['year'] = "<i>(" . $row['year'] . ")</i><br>";
        } else {
            $t['year'] = '';
        }
        if ($row['image']) {
            $t['image'] = htmlspecialcharsX($row['image']);
        } else {
            $t['image'] = '';
        }

        $albumi[] = $t;
    }

    \Tekstove\Cache::set(CACHE_ALBUM_LAST_10, $albumi, 2400);
}


$pozdrav = NULL;
$query_pozdrav = $pdo->query("SELECT `username`, `id`, `pozdrav` FROM `users` WHERE `pozdrav` LIKE ('%__%') ORDER BY RAND() LIMIT 1");
foreach ($query_pozdrav as $row_pozdrav) {
    $pozdrav .= "<a href=\"profile.php?profile=" . $row_pozdrav['id'] . '">' . htmlspecialchars($row_pozdrav['username']) . "</a> те поздравява с ";

    $stm = $pdo->prepare("SELECT `id`, `zaglavie_sakrateno` FROM `lyric` WHERE `id` = ? LIMIT 1");
    $stm->bindValue(1, $row_pozdrav['pozdrav'], PDO::PARAM_INT);
    $stm->execute();

    if ($stm->rowCount() > 0) {
        $stm = $stm->fetch();
        $pozdrav .= "<a href=\"browse.php?id=" . $stm['id'] . '">';
        $pozdrav .= htmlspecialchars($stm['zaglavie_sakrateno']) . "</a>";
    } else {
        $pozdrav = NULL;
    }

    lyric::proveri_imq_li_pesen($row_pozdrav['pozdrav'], $row_pozdrav['id']);
}


$stats = \Tekstove\Cache::get(CACHE_LYRIC_STATS);
if ($stats === false) {
    $stm = $pdo->prepare('
            (SELECT COUNT(`id`) FROM `lyric`)
        UNION ALL
            (SELECT COUNT(`id`) FROM `lyric` WHERE `text_bg` LIKE("%_%") )
        UNION ALL
            (SELECT COUNT(`id`) FROM `artists`)
        UNION ALL
            (SELECT COUNT(`id`) FROM `albums`)
        UNION ALL
            (SELECT COUNT(`id`) FROM `users`)

        ');
    $stm->execute();

    $stats['lyrics'] = $stm->fetch();
    $stats['lyrics'] = $stats['lyrics'][0];
    $stats['lyricsBG'] = $stm->fetch();
    $stats['lyricsBG'] = $stats['lyricsBG'][0];
    $stats['artists'] = $stm->fetch();
    $stats['artists'] = $stats['artists'][0];
    $stats['albums'] = $stm->fetch();
    $stats['albums'] = $stats['albums'][0];
    $stats['users'] = $stm->fetch();
    $stats['users'] = $stats['users'][0];

    Tekstove\Cache::set(CACHE_LYRIC_STATS, $stats, 3600);
}

    $broi_pesni = $stats['lyrics'];
    $broi_pesni_s_prevod = $stats['lyricsBG'];
    $broi_izpalnitelq = $stats['artists'];
    $broi_albuma = $stats['albums'];
    $broi_poptrebiteli = $stats['users'];

    unset($stats);

$stm = $pdo->prepare("SELECT `username`, `id` FROM `users` ORDER BY `id` DESC LIMIT 1");
$stm->execute();

$stm = $stm->fetch();

$posledno_registriran_id = $stm['id'];
$posledno_registriran_ime = htmlspecialcharsX($stm['username']);


Require (SITE_PATH_TEMPLATE . "index.php");