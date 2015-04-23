<?php
Require (__DIR__ . "/__top.php");

/* @var $pdo PDO */

$bez_reklami = true;
if ($username_id == 90) {
    greshka(NULL, 'Тестовият профил няма право да изпраща албум');
}

potrebitel::zadaljitelno_lognat($username_id);

if ($userclass < 1) {
    greshka(NULL, 'Само потребители с ранк + или по-голям могат да добавят албуми');
}

potrebitel::zadaljitelno_lognat($username_id);


if (isset($_POST['title'])) {
    $Stitle = $_POST['title'];
} else {
    $Stitle = NULL;
}

if (isset($_POST['artist1'])) {
    $Sartist1 = (int) $_POST['artist1'];
} else {
    $Sartist1 = 0;
}

if (isset($_POST['artist2'])) {
    $Sartist2 = (int) $_POST['artist2'];
} else {
    $Sartist2 = 0;
}

if (isset($_POST['image'])) {
    $Simage = strip_tags($_POST['image']);
} else {
    $Simage = NULL;
}

if (isset($_POST['year'])) {
    $Syear = (int) $_POST['year'];
} else {
    $Syear = 0;
}

if (isset($_POST['dopylnitelnoinfo'])) {
    $Sdopylnitelnoinfo = $_POST['dopylnitelnoinfo'];
} else {
    $Sdopylnitelnoinfo = NULL;
}

if (isset($_POST['album_vid'])) {
    $Svid = (int) $_POST['album_vid'];
} else {
    $Svid = NULL;
}

if (isset($_POST['va'])) {
    $Sva = 1;
} else {
    $Sva = 0;
}

for ($q = 0; $q <= 35; $q++) {

    if (isset($_POST['p' . $q])) {
        $Sp[$q] = $_POST['p' . $q];
    } else {
        $Sp[$q] = 0;
    }
    $Sp[$q] = str_replace("http://www.tekstove.info/browse.php?id=", "", $Sp[$q]);
    $Sp[$q] = str_replace("http://tekstove.info/browse.php?id=", "", $Sp[$q]);
    $Sp[$q] = (int) $Sp[$q];

    if (isset($_POST['p' . $q . 'n'])) {
        $Spn[$q] = $_POST['p' . $q . 'n'];
    } else {
        $Spn[$q] = NULL;
    }
}




if (isset($_POST['title'], $_POST['title'], $_POST['album_vid'])) {
    header('Content-type: application/json');
    
    $stm = $pdo->prepare("INSERT INTO `albums` (`image`, `name`, `artist1id`, `artist2id`, `dopylnitelnoinfo`, `vid`, `year`, `up_id`, `va`,
`p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`, `p10`, `p11`, `p12`, `p13`, `p14`, `p15`, `p16`, `p17`,`p18`, `p19`, `p20`, `p21`, `p22`, `p23`, `p24`, `p25`, `p26`, `p27`, `p28`, `p29`, `p30`, `p31`, `p32`, `p33`, `p34`, `p35`,
`p1n`, `p2n`, `p3n`, `p4n`, `p5n`, `p6n`, `p7n`, `p8n`, `p9n`, `p10n`, `p11n`, `p12n`, `p13n`, `p14n`, `p15n`, `p16n`, `p17n`, `p18n`, `p19n`, `p20n`, `p21n`, `p22n`, `p23n`, `p24n`, `p25n`, `p26n`, `p27n`, `p28n`, `p29n`, `p30n`, `p31n`, `p32n`, `p33n`, `p34n`, `p35n`)




VALUES ( :image, :title, :artist, :artist2, :dopylnitelnoinfo, :vid, :year, :up_id, :va,
:sp1, :sp2, :sp3, :sp4, :sp5, :sp6, :sp7, :sp8, :sp9, :sp10, :sp11, :sp12, :sp13, :sp14, :sp15, :sp16, :sp17, :sp18, :sp19, :sp20, :sp21, :sp22, :sp23, :sp24, :sp25, :sp26, :sp27, :sp28, :sp29, :sp30, :sp31, :sp32, :sp33, :sp34, :sp35,
:sp1n, :sp2n, :sp3n, :sp4n, :sp5n, :sp6n, :sp7n, :sp8n, :sp9n, :sp10n, :sp11n, :sp12n, :sp13n, :sp14n, :sp15n, :sp16n, :sp17n, :sp18n, :sp19n, :sp20n, :sp21n, :sp22n, :sp23n, :sp24n, :sp25n, :sp26n, :sp27n, :sp28n, :sp29n, :sp30n, :sp31n, :sp32n, :sp33n, :sp34n, :sp35n

)");

    $stm->bindValue(':image', $Simage, PDO::PARAM_STR);
    $stm->bindValue(':title', $Stitle, PDO::PARAM_STR);
    $stm->bindValue(':artist', $Sartist1, PDO::PARAM_INT);
    $stm->bindValue(':artist2', $Sartist2, PDO::PARAM_INT);
    $stm->bindValue(':dopylnitelnoinfo', $Sdopylnitelnoinfo, PDO::PARAM_STR);
    $stm->bindValue(':vid', $Svid, PDO::PARAM_INT);
    $stm->bindValue(':year', $Syear, PDO::PARAM_INT);
    $stm->bindValue(':up_id', $username_id, PDO::PARAM_INT);
    $stm->bindValue(':va', $Sva, PDO::PARAM_INT);

    for ($q = 1; $q <= 35; $q++) {
        $stm->bindValue(":sp{$q}", $Sp["$q"], PDO::PARAM_INT);
        $stm->bindValue(":sp{$q}n", $Spn["$q"], PDO::PARAM_STR);
    }

    $stm->execute();
    
    $albimId = $pdo->lastInsertId();

    Tekstove\Cache::delete(CACHE_ALBUM_LAST_10);
    
    $result = array(
        'status' => 'ok',
        'id' => $albimId,
    );
    
    echo json_encode($result);
    die();
    
} else {
    $Stitle = htmlspecialcharsX($Stitle);
    $Sdopylnitelnoinfo = htmlspecialcharsX($Sdopylnitelnoinfo);
    for ($q = 0; $q <= 35; $q++) {

        $Spn[$q] = htmlspecialcharsX($Spn[$q]);
    }


    $izpalniel_ime['1'] = lyric::artist_name_ot_id($Sartist1);
    $izpalniel_ime['2'] = lyric::artist_name_ot_id($Sartist2);

    $izpalniel_id['1'] = $Sartist1;
    $izpalniel_id['2'] = $Sartist2;
}


Require ( SITE_PATH_TEMPLATE . "albumsend.php");
