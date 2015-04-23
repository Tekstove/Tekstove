<?php
Require("__top.php");

if (isset ($_GET['s_novo'])) {
    $stranica = 0;
} elseif (isset ($_GET['s_stranica'])) {
    $stranica = (int)$_GET['s_stranica'];
} else { 
    $stranica = 0;
}

$pesni = null;

$tarsene = NULL;
$tarsene_dop_inf = NULL;
$tarsene_text = NULL;

if (isset($_GET['s_zaglavie'])) {
    $tarsene = $_GET['s_zaglavie'];
    $tarsene = trim($tarsene);
	$tarsene = preg_replace('/ (ft?\.?|feat\.?|и) /i', '%', $tarsene);
	$tarsene = preg_replace('|[ \-\(\)\*\&]+|', '%', $tarsene);
}

if (isset ($_GET['dop_inf'])) {
    $tarsene_dop_inf = $_GET['dop_inf'];
    $tarsene_dop_inf = trim($tarsene_dop_inf);
    $tarsene_dop_inf = preg_replace('|[ \-\(\)\*\&]+|', '%', $tarsene_dop_inf);
}

if (isset($_GET['s_text'])) {
    $tarsene_text = $_GET['s_text'];
	$tarsene_text = trim($tarsene_text);
	$tarsene_text = preg_replace('|[ \-\(\)\*\&]+|', '%', $tarsene_text);
}

if ($tarsene || $tarsene_text || $tarsene_dop_inf) {


    if($tarsene && $tarsene_text && $tarsene_dop_inf){
    $stm = $pdo->prepare('
        SELECT
            `id`,`zaglavie_sakrateno` FROM `lyric`
        WHERE
            (   
                LOWER(`zaglavie_palno`) LIKE LOWER( :zaglavie )
                AND LOWER(`text`) LIKE LOWER( :text )
                AND LOWER(`dopylnitelnoinfo`) LIKE LOWER( :dopinfo )
            )
        ORDER BY
            `id`
        LIMIT
            :stranica , 31
    ');
    $stm -> bindValue(':zaglavie', '%'.$tarsene.'%', PDO::PARAM_STR);
    $stm -> bindValue(':text', '%'.$tarsene_text.'%', PDO::PARAM_STR);
    $stm -> bindValue(':dopinfo', '%'.$tarsene_dop_inf.'%', PDO::PARAM_STR);
    $stm -> bindValue(':stranica', $stranica, PDO::PARAM_INT);
    } elseif ($tarsene && $tarsene_text) {
        $stm = $pdo->prepare('
            SELECT `id`,`zaglavie_sakrateno` FROM `lyric` WHERE
            (
                LOWER(`zaglavie_palno`) LIKE LOWER( ? )
                AND LOWER(`text`) LIKE LOWER( ? )
            ) ORDER BY `id` LIMIT ? , 31
        ');
        $stm -> bindValue(1, '%'.$tarsene.'%', PDO::PARAM_STR);
        $stm -> bindValue(2, '%' . $tarsene_text . '%', PDO::PARAM_STR);
        $stm->bindValue(3, $stranica, PDO::PARAM_INT);
    } elseif ($tarsene && $tarsene_dop_inf) {
        $stm = $pdo->prepare('
            SELECT `id`,`zaglavie_sakrateno` FROM `lyric` WHERE
            (
                LOWER(`zaglavie_palno`) LIKE LOWER( ? )
                AND LOWER(`dopylnitelnoinfo`) LIKE LOWER( ? )
            ) ORDER BY `id` LIMIT ? , 31
        ');
	$stm->bindValue(1, '%' . $tarsene . '%', PDO::PARAM_STR);
        $stm->bindValue(2, '%' . $tarsene_dop_inf . '%', PDO::PARAM_STR);
        $stm->bindValue(3, $stranica, PDO::PARAM_INT);
    } else if ($tarsene_dop_inf && $tarsene_text) {
        $stm = $pdo->prepare('
            SELECT
                `id`,`zaglavie_sakrateno` FROM `lyric`
            WHERE
                (
                    LOWER(`text`) LIKE LOWER( ? )
                    AND LOWER(`dopylnitelnoinfo`) LIKE LOWER( ? )
                ) ORDER BY `id` LIMIT ? , 31');
$stm ->bindValue(1, '%' . $tarsene_text . '%', PDO::PARAM_STR);
        $stm->bindValue(2, '%' . $tarsene_dop_inf . '%', PDO::PARAM_STR);
        $stm->bindValue(3, $stranica, PDO::PARAM_INT);
    } else if ($tarsene) {
        $stm = $pdo->prepare('SELECT `id`,`zaglavie_sakrateno` FROM `lyric` WHERE LOWER(`zaglavie_palno`) LIKE LOWER( ? ) ORDER BY `id` LIMIT ? , 31');
        $stm->bindValue(1, '%' . $tarsene . '%', PDO::PARAM_STR);
        $stm->bindValue(2, $stranica, PDO::PARAM_INT);
    } else if ($tarsene_text) {
        $stm = $pdo->prepare('SELECT `id`,`zaglavie_sakrateno` FROM `lyric` WHERE LOWER(`text`) LIKE LOWER( ? ) ORDER BY `id` LIMIT ? , 31');
        $stm->bindValue(1, '%' . $tarsene_text . '%', PDO::PARAM_STR);
        $stm->bindValue(2, $stranica, PDO::PARAM_INT);
    } else if ($tarsene_dop_inf) {
        $stm = $pdo->prepare('SELECT `id`,`zaglavie_sakrateno` FROM `lyric` WHERE LOWER(`dopylnitelnoinfo`) LIKE LOWER( ? ) ORDER BY `id` LIMIT ? , 31');
        $stm->bindValue(1, '%' . $tarsene_dop_inf . '%', PDO::PARAM_STR);
        $stm->bindValue(2, $stranica, PDO::PARAM_INT);
    } else
        greshka('Грешка при търсенето не е хванат случай на полета');

    $stm->execute();


    $rezultata = $stm->rowCount();

    $br = 0;

    foreach ($stm->fetchAll() as $r) {
        $pesni[] = array('id' => $r['id'], 'zaglavie' => htmlspecialchars($r['zaglavie_sakrateno']));
    }
} //get

$meta_title = 'Търсачка';


Require(SITE_PATH_TEMPLATE . '__top.php');

if (isset($rezultata) && $rezultata == 0) {
    ?> Няма намерени резултати <?php
}

?>
<br><br>
<form action="" method="get">
    <b>Въведете първо изпълнителя и след това името на песента<br>
    Например <u>50 cent - In Da Club</u></b><br>
    <input type="text" name="s_zaglavie" value="<?php if(isset ($_GET['s_zaglavie']) )echo htmlspecialchars($_GET['s_zaglavie']); ?>" size="30">
    <input type="hidden" name="s_stranica" value="<?php echo $stranica; ?>">
    <br>
    <input type="hidden" name="s_novo" value="1">

    <div>
        <br>
        Търсене в текста<br>
        <input type="text" name="s_text" size="30" value="<?php if(isset ($_GET['s_text'])) echo htmlspecialchars($_GET['s_text']); ?>">

        <br>
        Търсене в допълнителната информация<br>
        <input type="text" name="dop_inf" size="30" value="<?php if(isset ($_GET['dop_inf'])) echo htmlspecialchars($_GET['dop_inf']); ?>">
        <br><br>


    </div>
    <input type="submit" name="s_tarsi" value="Търси">
</form>
<hr>

<?php if($pesni) foreach ($pesni as $r) {
    ?><a href="browse.php?id=<?php echo $r['id']; ?>" target="_BLANK"><?php echo $r['zaglavie']; ?></a><br><?php
    $br++;

if ($br > 30) {     // ако има още резултати
    ?><br><a href="?s_zaglavie=<?php
    if(isset ($_GET['s_zaglavie'])) echo urlencode($_GET['s_zaglavie']);
    ?>&s_text=<?php
    if(isset ($_GET['s_text'])) echo urlencode($_GET['s_text']);
    ?>&dop_inf=<?php
    if(isset ($_GET['dop_inf'])) echo urlencode($_GET['dop_inf']);
    ?>&s_stranica=<?php echo ($br+$stranica-1); ?>"><b>следваща страница &gt;&gt;</b></a>
    <?php }

}

Require (SITE_PATH_TEMPLATE . "__bdqsno.php");