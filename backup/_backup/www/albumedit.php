<?php
Require ("__top.php");

$bez_reklami = true;

$bez_reklami = true;

if (isset($_GET['id']))
    $id = (int) $_GET['id'];
else
    greshka('ненамерен албум', 'не намирам албума');

setcookie('album_id_po_taka_l', $id);


if ($username_id == 90)
    greshka(NULL, 'Тестовият профил няма право да изпраща албум');
potrebitel::zadaljitelno_lognat($username_id);

try {





    $stm = $pdo->prepare('SELECT * FROM `albums` WHERE `id` = ? ');
    $stm->bindValue(1, $id, PDO::PARAM_INT);

    $stm->execute();

    if ($stm->rowCount() == 0)
        greshka('', 'Не намирам албума');

    $album = $stm->fetch();

    if (($username_id != $album['up_id']) && $userclass < 20)
        greshka('', 'Нямаш право да променяш този албум');














    if (isset($_POST['submit'])) {



        if (isset($_POST['title'])
            )$Stitle = $_POST['title'];
        else
            $Stitle = NULL;

        if (isset($_POST['artist1']))
            $Sartist1 = (int) $_POST['artist1'];
        else
            $Sartist1 = 0;

        if (isset($_POST['artist2']))
            $Sartist2 = (int) $_POST['artist2'];
        else
            $Sartist2 = 0;

        if (isset($_POST['image']))
            $Simage = strip_tags($_POST['image']);
        else
            $Simage = NULL;

        if (isset($_POST['year']))
            $Syear = (int) $_POST['year'];
        else
            $Syear = 0;

        if (isset($_POST['dopylnitelnoinfo']))
            $Sdopylnitelnoinfo = $_POST['dopylnitelnoinfo'];
        else
            $Sdopylnitelnoinfo = NULL;

        if (isset($_POST['album_vid']))
            $Svid = (int) $_POST['album_vid'];
        else
            $Svid = NULL;

        if (isset($_POST['va']))
            $Sva = 1;
        else
            $Sva = 0;


        //print_r($Sp);

        echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;

        for ($q = 1; $q <= 35; $q++) {

            if (isset($_POST['p' . $q]))
                $Sp[$q] = $_POST['p' . $q];
            else
                $Sp[$q] = 0;
            $Sp[$q] = str_replace("http://www.tekstove.info/browse.php?id=", "", $Sp[$q]);
            $Sp[$q] = str_replace("http://tekstove.info/browse.php?id=", "", $Sp[$q]);
            $Sp[$q] = (int) $Sp[$q];

            if (isset($_POST['p' . $q . 'n']))
                $Spn[$q] = $_POST['p' . $q . 'n'];
            else
                $Spn[$q] = NULL;
        }


        //print_r($Sp);
        //die();

        /*



         */


        $stm = $pdo->prepare("UPDATE `albums` SET `name`= :name, `year` = :year, `image`= :image, `artist1id`= :artist1, `artist2id`= :artist2,
                `dopylnitelnoinfo`= :dopylnitelnoinfo, `va`= :va, `vid`= :vid,
                 `p1`= :p1, `p2`= :p2, `p3`= :p3, `p4`= :p4, `p5`= :p5, `p6`= :p6, `p7`= :p7, `p8`= :p8, `p9`= :p9, `p10`= :p10, `p11`= :p11, `p12`= :p12, `p13`= :p13, `p14`= :p14, `p15`= :p15, `p16`= :p16, `p17`= :p17, `p18`= :p18, `p19`= :p19, `p20`= :p20, `p21`= :p21, `p22`= :p22, `p23`= :p23, `p24`= :p24, `p25`= :p25, `p26`= :p26, `p27`= :p27, `p28`= :p28, `p29`= :p29, `p30`= :p30, `p31`= :p31, `p32`= :p32, `p33`= :p33, `p34`= :p34, `p35`= :p35,
                  `p1n`= :p1n, `p2n`= :p2n, `p3n`= :p3n, `p4n`= :p4n, `p5n`= :p5n, `p6n`= :p6n, `p7n`= :p7n, `p8n`= :p8n, `p9n`= :p9n, `p10n`= :p10n, `p11n`= :p11n, `p12n`= :p12n, `p13n`= :p13n, `p14n`= :p14n, `p15n`= :p15n, `p16n`= :p16n, `p17n`= :p17n, `p18n`= :p18n, `p19n`= :p19n, `p20n`= :p20n, `p21n`= :p21n, `p22n`= :p22n, `p23n`= :p23n, `p24n`= :p24n, `p25n`= :p25n, `p26n`= :p26n, `p27n`= :p27n, `p28n`= :p28n, `p29n`= :p29n, `p30n`= :p30n, `p31n`= :p31n, `p32n`= :p32n, `p33n`= :p33n, `p34n`= :p34n, `p35n`= :p35n

                WHERE `id` = :id LIMIT 1");


        $stm->bindValue(':image', $Simage, PDO::PARAM_STR);
        $stm->bindValue(':name', $Stitle, PDO::PARAM_STR);
        $stm->bindValue(':artist1', $Sartist1, PDO::PARAM_INT);
        $stm->bindValue(':artist2', $Sartist2, PDO::PARAM_INT);
        $stm->bindValue(':dopylnitelnoinfo', $Sdopylnitelnoinfo, PDO::PARAM_STR);
        $stm->bindValue(':vid', $Svid, PDO::PARAM_INT);
        $stm->bindValue(':year', $Syear, PDO::PARAM_INT);
        $stm->bindValue(':va', $Sva, PDO::PARAM_INT);

        for ($q = 1; $q <= 35; $q++) {
            $stm->bindValue(":p{$q}", $Sp[$q], PDO::PARAM_INT);
            $stm->bindValue(":p{$q}n", $Spn[$q], PDO::PARAM_STR);
        }

        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        $stm->execute();

        apc_delete(CACHE_ALBUM_LAST_10);
?><META HTTP-EQUIV="refresh" content="1;URL=albumvij.php?id=<?php echo $id; ?>">
        <a href="albumvij.php?id=<?php echo $id; ?>">Готово,пренасочване</a>
<?php
        die();
    }
    //------------------------------------------------------------------
    else {

        $album['name'] = htmlspecialcharsX($album['name']);
        $album['artist1_ime'] = lyric::artist_name_ot_id($album['artist1id']);
        $album['artist2_ime'] = lyric::artist_name_ot_id($album['artist2id']);

        for ($q = 1; $q <= 35; $q++) {
            $album['p' . $q . 'n'] = htmlspecialcharsX($album['p' . $q . 'n']);
        }
    }
} catch (Exception $e) {
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "albumedit.php");
?>