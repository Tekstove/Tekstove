<?php
Require("__top.php");

$SQL = '';
$linkfiltyr = '';
$js_filter = '';

foreach (lyric::janrove() as $k => $v) {

    $js_filter .= '<input type="checkbox" name="' . $k . '" value="1" onClick=\\\'razgledai_filter_stranica("none")\\\' ';

    if (isset($_REQUEST['' . $k . ''])) {
        if ($SQL) {
            $SQL .= " OR `$k` = 1 ";
        } else {
            $SQL = " `$k` = 1 ";
        }
        $linkfiltyr .= "&amp;$k=1";


        $js_filter .= 'checked="checked" ';

    }
     $js_filter .= '>'  . $v;
}

$js_ezik_filter = '<br>Песента се пее на <select name="pee_se_na">';
foreach (lyric::ezici() as $k => $v) {
    if (isset($_REQUEST['pee_se_na']) && $_REQUEST['pee_se_na'] == $k) {
        $js_ezik_filter .= '<option selected value="' . $k . '">' . $v;
    } else {
        $js_ezik_filter .= '<option value="' . $k . '">' . $v;
    }
}
$js_ezik_filter .= '</select>';





if (isset($_REQUEST['page'])) {
    $page = (integer) $_REQUEST['page'];
} else {
    $page = 0;
}
$pagesql = ((integer) $page) * 25;



if ($SQL) {
    $SQL = " ( " . $SQL . " ) ";
}

if (isset($_REQUEST['pee_se_na']) && $_REQUEST['pee_se_na'] != 0) {
    if ($SQL) {
        $SQL .= " AND ";
    }
    $SQL .= ' `pee_se_na` = ' . (int) $_REQUEST['pee_se_na'];
    $linkfiltyr = $linkfiltyr . "&amp;pee_se_na=".(int)$_REQUEST['pee_se_na'];
    
    }

if (isset($_REQUEST['prevod'])) {
    if ($SQL) {
        $SQL .= " AND ";
    }
    $SQL = $SQL . " `text_bg` LIKE ('%_%') ";
    $linkfiltyr = $linkfiltyr . "&amp;prevod=1";
}

if ($SQL) {
    $SQL = " WHERE " . $SQL;
}

$stm = $pdo->prepare("
    SELECT
        `id`, `zaglavie_sakrateno`, `video_vbox7`, `video_youtube`
    FROM
        `lyric`
    ".$SQL."
    ORDER BY
        `id` DESC
    LIMIT
            $pagesql, 26
");
$stm -> execute();

$pesni = $stm->fetchAll();




$stm = $pdo->prepare("
    SELECT
        COUNT(`id`) AS `kolko`
    FROM
        `lyric`
    $SQL
");
$stm->execute();
$temp = $stm->fetch();

$pesni_obshto = $temp[0];
unset($temp);


require SITE_PATH_TEMPLATE . 'razgledai.php';
