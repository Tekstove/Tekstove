<?php
Require("__top.php");

try{

if(isset ($_REQUEST['id'])) $id=(integer)$_REQUEST['id'];
else $id=NULL;

if($id) {$stm = $pdo->prepare("SELECT * FROM `lyric` WHERE
    `artist1` = :id	OR `artist2` = :id OR `artist3` = :id OR `artist4` = :id OR `artist5` = :id OR `artist6` = :id
	ORDER BY RAND()	LIMIT 1");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
		$stm->execute();

		if ($stm->rowCount() == 0)
			greshka(NULL, 'няма намерени песни към изпълнителя');
		$pesen = new lyric($stm->fetch());
	}



	else {
		$pesen = lyric::getRandomLyric();
	}
$text = $pesen->getText(false, false);
$text = str_replace($pesen->getArtist1_ime(1),"*",$text);
$text = str_replace($pesen->getArtist2_ime(1),"*",$text);
$text = str_replace($pesen->getArtist3_ime(1),"*",$text);
$text = str_replace($pesen->getArtist4_ime(1),"*",$text);
$text = str_replace($pesen->getArtist5_ime(1),"*",$text);
$text = str_replace($pesen->getArtist6_ime(1),"*",$text);





$ot = rand(0,mb_strlen( $text )-180);

$text_hint = mb_substr($text,$ot,180);



$text_hint = preg_replace("/\[.*\]/isu", "---",$text_hint);


$text_hint=nl2br(htmlspecialchars($text_hint));
$text=nl2br(htmlspecialchars($text));
$text=str_replace($text_hint,"<font color=\"red\"><b><u>".$text_hint."</u></b></font>",$text);


$artist_ime = lyric::artist_name_ot_id($id);


}
catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "igra.php");
?>