<?php Require(SITE_PATH_TEMPLATE . '__top.php');
/* @var $pesen lyric */
?>
	<script type="text/javascript">
	function igra_show() {
document.getElementById("igra_1").style.display = "block";
document.getElementById("igra_2").style.display = "block";
document.getElementById("igra_1a").style.display = "none";
			}
		</script>




<table class="igra">
<tr><td>
<a href="?id=<?php echo $id; ?>"><b><u>Друг текст
<?php if($id) { ?> на <?php echo $artist_ime; } ?>
</u></b></a>
<hr>
</td></tr>


<tr><td class="igra">

<hr>
<span id="igra_1a"><a href="#" onCLick="javascript:igra_show();return false"><b><u>Покажи коя е песента</u></b><br>
    <?php echo $text_hint; ?>
    </a></span>
<br>

<span id="igra_2" style="display:none;"><?php echo $text; ?></span>

</td><td class="igra" Valign="top">
	<div id="igra_1" style="display:none;">
	<br><a href="browse.php?id=<?php echo $pesen->getId(); ?>"><b><?php echo $pesen->get_Zaglavie_sakrateno(); ?></b></a><br><br>
	<?php if( $pesen->getVideo_youtube() ) { ?><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="450" height="403"><param name="movie" value="http://i47.vbox7.com/player/ext.swf?vid=<?php echo $pesen->getVideo_vbox7(); ?>"><param name="quality" value="high"><embed src="http://i47.vbox7.com/player/ext.swf?vid=<?php echo $pesen->getVideo_vbox7(); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="450" height="403"></embed></object><?php }
		//else if( $row['video_youtube'] ) echo "<object width=\"425\" height=\"355\"><param name=\"movie\" value=\"".htmlspecialchars($row['video_youtube'])."\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"".htmlspecialchars($row['video_youtube'])."\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"355\"></embed></object>";
 			//else if($row['video'] ) echo "<a href=\"".htmlspecialchars($row['video'])."\" target=\"_blanc\">".htmlspecialchars($row['video'])."</a>";
	?></div>


</td></tr></table>







<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>