<?php
Require ("__top.php");

$meta_title = 'Изпращане на нов текст';
$bez_reklami = true;

try{



        $lyric_attr = array ('artist1','artist2','artist3','artist4','artist5','artist6',
            'text', 'text_bg', 'title', 'album1', 'album2',
            'video', 'video_vbox7', 'video_youtube', 'video_metacafe',
            'image', 'dopylnitelnoinfo', 'pee_se_na');

       foreach ($lyric_attr as $v) {
        if(isset ($_POST["$v"])) $pesen["$v"] = $_POST["$v"];
         else $pesen["$v"] = '';
       }
       $pesen['video'] = strip_tags($pesen['video']);
       $pesen['video_vbox7'] = strip_tags($pesen['video_vbox7']);
       $pesen['video_youtube'] = strip_tags($pesen['video_youtube']);
       $pesen['video_metacafe'] = strip_tags($pesen['video_metacafe']);


$S_janrove_poleta=NULL;
$S_janrove_poleta_pdo = NULL;
       foreach (lyric::janrove() as $k => $v) {
           if(isset ($_POST["$k"])) $pesen["$k"] = 1;
           else $pesen["$k"] = '';

           $S_janrove_poleta .= ', `'.$k.'`';
           $S_janrove_poleta_pdo .= ", :$k";


       }

       foreach ($pesen as &$v) {
        $v = trim($v);
       } unset($v);

        $pesen['artist1_ime'] = lyric::artist_name_ot_id($pesen['artist1'], TRUE);
        $pesen['artist2_ime'] = lyric::artist_name_ot_id($pesen['artist2'], TRUE);
        $pesen['artist3_ime'] = lyric::artist_name_ot_id($pesen['artist3'], TRUE);
        $pesen['artist4_ime'] = lyric::artist_name_ot_id($pesen['artist4'], TRUE);
        $pesen['artist5_ime'] = lyric::artist_name_ot_id($pesen['artist5'], TRUE);
        $pesen['artist6_ime'] = lyric::artist_name_ot_id($pesen['artist6'], TRUE);

$bot_li_e = false;
if(!$username) {
    $bot_li_e = true;
    if(     isset ($_POST['antispam'])
            && (
                   ( mb_strtolower($_POST['antispam']) == 'ne') || ( mb_strtolower($_POST['antispam']) == 'не') )



            ) $bot_li_e = false;
}

if( ( isset ($_POST['submit'], $_POST['title'], $_POST['text']) && $_POST['title'] && $_POST['text'])
        
        && empty ($_POST['linkss']) && ($bot_li_e == false )        ){
        
    if(!isset ($_POST['dobavi'])){

	$stm = $pdo->prepare ("SELECT * FROM `lyric` WHERE LOWER(`title`)=LOWER( ? )");
        $stm->bindValue(1, $pesen['title'], PDO::PARAM_STR);
        $stm->execute();
	foreach ($stm->fetchAll() as $v) {
 	$pesni_povtoreniq[] = htmlspecialchars($v['zaglavie_sakrateno']);
	}
	
	}



if (!isset($pesni_povtoreniq)) {

	$Salbum=str_replace("http://www.tekstove.info/albumvij.php?id=" , "" , $pesen['album1'] );
	$Salbum=str_replace("http://tekstove.info/albumvij.php?id=" , "" , $Salbum );
	$Salbum        =   (integer)$Salbum;
	
	$Salbum2=str_replace("http://www.tekstove.info/albumvij.php?id=" , "" , $pesen['album2'] );
	$Salbum2=str_replace("http://tekstove.info/albumvij.php?id=" , "" , $Salbum2 );
	$Salbum2        =   (integer)$Salbum2;
	
	

	
	
	$Svideo_vbox7  =   lyric::videoc_vboxcode($pesen['video_vbox7']);
        $Svideo_youtube = lyric::video_youtube($pesen['video_youtube']);
        $Svideo_metacafe = lyric::videoc_metacafecode($pesen['video_metacafe']);


    $stm=$pdo->prepare("INSERT INTO `lyric` (`up_id`, `text`, `text_bg`,
        `artist1`, `artist2`, `artist3`, `artist4`, `artist5`, `artist6`, `title`,
         `album1`, `album2`, `video`, `video_vbox7`, `video_youtube`, `video_metacafe`,
         `image`, `ip_upload`, `dopylnitelnoinfo`, `pee_se_na` ".$S_janrove_poleta."

               )
	VALUES (
 :up_id, :text, :text_bg,
 :artist1, :artist2, :artist3, :artist4, :artist5, :artist6, :title,
 :album1, :album2, :video, :video_vbox7, :video_youtube, :video_metacafe,
 :image, :ip_upload, :dopylnitelnoinfo, :pee_se_na ".$S_janrove_poleta_pdo."

    ) ");


    $stm->bindValue(':up_id', $username_id, PDO::PARAM_INT);
    $stm->bindValue(':text', $pesen['text'],PDO::PARAM_STR);
    $stm->bindValue(':text_bg', $pesen['text_bg'],PDO::PARAM_STR);

    $stm->bindValue(':artist1', $pesen['artist1'], PDO::PARAM_INT);
    $stm->bindValue(':artist2', $pesen['artist2'], PDO::PARAM_INT);
    $stm->bindValue(':artist3', $pesen['artist3'], PDO::PARAM_INT);
    $stm->bindValue(':artist4', $pesen['artist4'], PDO::PARAM_INT);
    $stm->bindValue(':artist5', $pesen['artist5'], PDO::PARAM_INT);
    $stm->bindValue(':artist6', $pesen['artist6'], PDO::PARAM_INT);
    $stm->bindValue(':title', $pesen['title'], PDO::PARAM_STR);

    $stm->bindValue(':album1', $pesen['album1'], PDO::PARAM_INT);
    $stm->bindValue(':album2', $pesen['album2'], PDO::PARAM_INT);

    $stm->bindValue(':video', $pesen['video'], PDO::PARAM_STR);
    $stm->bindValue(':video_vbox7', $Svideo_vbox7, PDO::PARAM_STR);
    $stm->bindValue(':video_youtube', $Svideo_youtube, PDO::PARAM_STR);
    $stm->bindValue(':video_metacafe', $Svideo_metacafe, PDO::PARAM_STR);

    $stm->bindValue(':image', $pesen['image'], PDO::PARAM_STR);
    $stm->bindValue(':ip_upload', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
    $stm->bindValue(':dopylnitelnoinfo', $pesen['dopylnitelnoinfo'], PDO::PARAM_STR);
    $stm->bindValue(':pee_se_na', $pesen['pee_se_na'], PDO::PARAM_INT);

    foreach (lyric::janrove() as $k => $v) {
        if($pesen["$k"]) $stm->bindValue(':'.$k, 1, PDO::PARAM_INT);
        else $stm->bindValue(':'.$k, 0, PDO::PARAM_INT);

    }


    $stm->execute();


		if($username){
		$stm_user_update = $pdo->prepare("UPDATE `users`
                    SET
                        `br_pesni`=(`br_pesni`+1),
                        `activity_points` = (`activity_points` + 35)
                        
                    WHERE `id` = ? LIMIT 1");
                $stm_user_update -> bindValue(1, $username_id, PDO::PARAM_INT);
                $stm_user_update->execute();
		}
	
	
		$stm = $pdo->prepare('SELECT `id` FROM `lyric` ORDER BY `id` DESC LIMIT 1');
                $stm->execute();
                $stm=$stm->fetch();
		
		$lyric = new lyric((int)$stm['id']);
		$lyric->updateCache();
        
        if (false === $lyric->isCenzored()) {
            $contentChcker = \Tekstove\Registry::getInstance()->getContentCecker();
            $isSafe = $contentChcker->isSafe($lyric->getText(false, false));
            
            if (false === $isSafe) {
                $stmCenzore = $pdo->prepare("INSERT INTO `lyric_18` (`id`) VALUES ( :id )");
                $stmCenzore->bindValue(':id', $lyric->getId(), PDO::PARAM_INT);
                $stmCenzore->execute();
            }
        }
		
		?>Готово...пренасочване<META HTTP-EQUIV="refresh" content="0;URL=browse.php?id=<?php echo $stm['id'];?>">
		<?php

                die();
			} // ako nqma povtoreniq
	

} // if POST
// ------------------------------------------------------------------


                if(isset ($_COOKIE['album_id_po_taka_l'])) {
                $stm= $pdo->prepare("SELECT `name`,`id` FROM `albums` WHERE `id` = ? LIMIT 1");
                $stm->bindValue(1, $_COOKIE['album_id_po_taka_l'], PDO::PARAM_INT);
                $stm->execute();
                $data = $stm->fetch();
                $pesen_album_hint_ime = htmlspecialchars($data['name']);
                $pesen_album_hint_id = $data['id'];
                unset($data);
                }



}
catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "uploadliryc.php");
?>