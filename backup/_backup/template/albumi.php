<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>


<div style="width:100%;text-align:right;">
<?php if($album_vid==1) { ?>Музика от
  <b>Албуми</b>
  <a href="?album_vid=2" title="Покажи само албуми от тип озвучение към филми">Филми</a>
  <a href="?album_vid=3" title="Покажи само албуми от тип озвучение към игри">Игри</a>
  
<?php } else if ($album_vid==2) { ?>Музика от
  <a href="?album_vid=1" title="Покажи само музикални албуми">Албуми</a>
  <b>Филми</b>
  <a href="?album_vid=3" title="Покажи само албуми от тип озвучение към игри">Игри</a>
 
  <?php } else if($album_vid==3) { ?> Музика от
  <a href="?album_vid=1" title="Покажи само музикални албуми">Албуми</a>
  <a href="?album_vid=2" title="Покажи само албуми от тип озвучение към филми">Филми</a>
  <b>Игри</b>

  <?php } else { ?> Музика от
  <a href="?album_vid=1" title="Покажи само музикални албуми">Албуми</a>
  <a href="?album_vid=2" title="Покажи само албуми от тип озвучение към филми">Филми</a>
  <a href="?album_vid=3" title="Покажи само албуми от тип озвучение към игри">Игри</a>
  <?php } ?>


</div>
<table class="albums" align="center"><tr>
<?php $i=0; $i2=0; foreach ($albumi as $v) {

$i++;
if($i>=17) break;
?>
<td class="albumstd" align="center">
<a href="albumvij.php?id=<?php echo $v['id']; ?>">
<?php echo  lyric::artist_name_ot_id($v['artist1id']);
if($v['artist2id']) echo  " и ".lyric::artist_name_ot_id($v['artist2id']); ?>
<br><b><?php echo htmlspecialcharsX($v['name']); ?></b>
<?php if($v['year']) { ?><br><i>( <?php echo $v['year']; ?> )</i> <?php } ?>
<?php if($v['image']) { ?><br><img src="<?php echo $v['image']; ?>" width=130 height=130 ALT="Обложка"> <?php } ?>
</a>
	</td>

<?php $i2++;
if(($i2>=4)&&($i!=16)) {$i2=0; ?></tr><tr> <?php }
} // foreach
?> </tr></table>

<?php if($album_vid){
if($i>=17) { ?> <br><center><a href="albumi.php?stranica=<?php echo ($stranica+1); ?>&album_vid=<?php echo $album_vid; ?>">
        <b><u><font size=4>Следваща страница &gt;&gt;&gt;</font></u></b></a></center> <?php }
}
else {
if($i>=17) { ?> <br><center>
        <a href="albumi.php?stranica=<?php echo ($stranica+1); ?>">
            <b><u><font size=4>Следваща страница &gt;&gt;&gt;</font></u></b></a>
	</center> <?php } } ?>







<?php Require ("__bdqsno.php"); ?>
