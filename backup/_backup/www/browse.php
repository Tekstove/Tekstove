<?php
/* @var $pdo pdo */
/* @var $stm PDOStatement */

require "__top.php";


if (!isset($_GET['id'])) {
    greshka('Няма намерана песен', 'Няма намерана песен', $header = 404, false);
}
$id = (integer) $_GET['id'];

try {
    $pesen = new lyric($id, true);
} catch (Exception $e) {

    switch ($e->getCode()) {
        case 301:
            headerHeler::pernamentRedirect('/browse.php?id=' . $e->getMessage());
            die();
            break;
        case 404:
            greshka('Няма намерана песен', 'Няма намерана песен', 404, false);
            break;
        default:
            greshka($e);
            break;
    }


    if ($e->getCode() == 301) {
        
    } else {
        throw $e;
    }
}

if ($pesen->getForbidden()) {
    greshka(null, 'забранен изпълнител', 200, false);
}

$pesen->increaseViews();

if ($pesen->cenzora18()) {
    Tekstove\Registry::getInstance()->setAdsense(false);
} else {
    Tekstove\Registry::getInstance()->setAdsense(true);
}





$pesen_v_liubimi_li_e = false;
$pesen_sobstvenik = false;
$pesen_potrebitel_glasuval_li_e = true;
if (currentUser::isLogged()) {
    
    $user = currentUser::getInstance();
    
    $stm_liubimi = $pdo->prepare("SELECT `id` FROM `liubimi` WHERE `pesen` = ? AND `username`= ? LIMIT 1");
    $stm_liubimi->bindValue(1, $pesen->getId(), PDO::PARAM_INT);
    $stm_liubimi->bindValue(2, $user->getId(), PDO::PARAM_INT);
    $stm_liubimi->execute();

    if ($stm_liubimi->rowCount()) {
        $pesen_v_liubimi_li_e = true;
    }
    
    if (($pesen->getUp_id() === $user->getId()) || ($userclass >= 10)) {
        $pesen_sobstvenik = true;
    }
    
    $stm_glasuval_li = $pdo->prepare("SELECT `id` FROM `glasuvane` WHERE `za`= ? AND `ot`= ? ");
    $stm_glasuval_li->bindValue(1, $pesen->getId(), PDO::PARAM_INT);
    $stm_glasuval_li->bindValue(2, $user->getId(), PDO::PARAM_INT);
    $stm_glasuval_li->execute();

    if ($stm_glasuval_li->rowCount()) {
        $pesen_potrebitel_glasuval_li_e = TRUE;
    } else {
        $pesen_potrebitel_glasuval_li_e = FALSE;
    }
}



//---------- Albumi
$pesen_albumi = NULL;
if ($pesen->getAlbum1()) {
    $stm_album = $pdo->prepare("SELECT * FROM `albums` WHERE `id` = ? LIMIT 1");
    $stm_album->bindValue(1, $pesen->getAlbum1());
    $stm_album->execute();

    if ($stm_album->rowCount()) {
        $row_album = $stm_album->fetch();
        $temp['ime'] = htmlspecialcharsX($row_album['name']);
        $temp['id'] = $row_album['id'];
        $pesen_albumi[] = $temp;
    }

    if ($pesen->getAlbum2()) {
        // using last prepared statemanet  $stm_album = $pdo->prepare("SELECT * FROM `albums` WHERE `id` = ? LIMIT 1");
        $stm_album->bindValue(1, $pesen->getAlbum2());
        $stm_album->execute();

        if ($stm_album->rowCount()) {
            $row_album = $stm_album->fetch();
            $temp['ime'] = htmlspecialcharsX($row_album['name']);
            $temp['id'] = $row_album['id'];
            $pesen_albumi[] = $temp;
        }
    }
}  //------------ Krai albumi
// ===== krai video sekciq

if ($pesen->getUp_id()) {
    $pesen_izpratil['id'] = $pesen->getUp_id();
    $pesen_izpratil['ime'] = potrebitel::ime_ot_id($pesen->getUp_id());
} else {
    $pesen_izpratil = NULL;
}


$pesen_pee_se_na = NULL;
if ($pesen->getPee_se_na()) {
    foreach (lyric::ezici() as $FE_id => $FE_ime) {
        if ($pesen->getPee_se_na() == $FE_id) {
            $pesen_pee_se_na['id'] = $FE_id;
            $pesen_pee_se_na['ime'] = $FE_ime;
            break;
        }
    }
}

if (isset($_GET['kompr'])) {
    $kompr = (int) $_GET['kompr'];
} else {
    $kompr = 0;
}

if ($kompr) {
    $filterByCommentId = true;
} else {
    $filterByCommentId = false;
}

$stm_kom = $pdo->prepare("
    SELECT
        `comments`.*,
        `avatar`,
        `skype`,
        `username`
    FROM
        `comments`
    INNER JOIN
        `users`
            ON
                users.id = `comments`.sendby
    WHERE
        `zakoqpesen` = ?
        AND (
            `comments`.`id` <= ?
            OR ?
        )
    ORDER BY
        `comments`.`id` DESC
    LIMIT 11
");

$stm_kom->bindValue(1, $pesen->getId(), PDO::PARAM_INT);
$stm_kom->bindValue(2, $kompr, PDO::PARAM_INT);
$stm_kom->bindValue(3, !$filterByCommentId, PDO::PARAM_BOOL);

$stm_kom->execute();
$stm_kom_fetch = $stm_kom->fetchAll();
$imalio6tecom = 0;
$pesen_komentari = NULL;


foreach ($stm_kom_fetch as $rowcom) { // $stm_kom_fetch is empy array()
    $imalio6tecom++;
    if ($imalio6tecom == 11) {
        $pesen_oshte_komentari = 'browse.php?id=' . $pesen->getId() . '&kompr=' . $rowcom['id'];
    } else {

        $temp['user_skype'] = skype_code($rowcom['skype']);
        $temp['user_id'] = $rowcom['sendby'];
        $temp['user_ime'] = htmlspecialcharsX($rowcom['username']);
        $temp['data_orig'] = $rowcom['date_orig'];
        if ((currentUser::isLogged() && currentUser::getInstance()->getId() == $rowcom['sendby']) || ($userclass >= 20)) {
            $temp['owner'] = true;
        } else {
            $temp['owner'] = false;
        }

        $temp['user_avatar'] = htmlspecialcharsX($rowcom['avatar']);
        $temp ['text'] = nl2br_my((htmlspecialcharsX($rowcom['text'])));
        $temp['id'] = $rowcom['id'];
        $pesen_komentari[] = $temp;
    }
}


$meta_title = NULL;
if ($pesen->getArtist1()) {
    $meta_title .= $pesen->getArtist1_ime();
    if ($pesen->getArtist2()) {
        $meta_title .= ' и ' . $pesen->getArtist2_ime();
        if ($pesen->getArtist3()) {
            $meta_title .= ' и ' . $pesen->getArtist3_ime();

            if ($pesen->getArtist4()) {
                $meta_title .= ' и ' . $pesen->getArtist4_ime();

                if ($pesen->getArtist5()) {
                    $meta_title .= ' и ' . $pesen->getArtist5_ime();

                    if ($pesen->getArtist6()) {
                        $meta_title .= ' и ' . $pesen->getArtist6_ime();
                    }
                }
            }
        }
    }
}

$meta_title .= ' - ' . $pesen->getTitle() . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;текст';
if ($pesen->getText_bg(false, false)) {
    $meta_title .= ' и превод';
}





require SITE_PATH_TEMPLATE . "browse.php";