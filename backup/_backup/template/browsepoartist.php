<?php
/* @var $artist Artist */
?>
<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<?php if ($userclass>=20) : ?>
	<div style="width:100%;text-align:right;">
		<a href="mod.php?artist_edit=<?php echo $artist->getId(); ?>">
			промени&nbsp;&nbsp;
		</a>
	</div>
<?php endif; ?>


<h1>
	<?php echo $artist->getName(); ?>
</h1>
<a href="liubimi_play.php?ispalnitel=<?php echo $artist->getId(); ?>"><img src="images/play.png" ALT="слушай">слушай песните</a>





<table>
<?php if(isset ($albumi)){ ?>
<tr><td>
 <?php  foreach ($albumi as $v) { ?>
			<div class="album_po_artist">
				<div class="album_po_artist_v">
			<a href="albumvij.php?id=<?php echo $v['id']; ?>">
                            <b><?php echo htmlspecialcharsX($v['name']); ?></b>

			<?php if($v['year']) { ?><br><i>(<?php echo $v['year']; ?>)</i> <?php }
			if($v['image']) { ?><br><img src="<?php echo $v['image']; ?>" class="max130" ALT="Обложка"><?php } ?>
			</a>
				</div></div>

			<?php } ?>
        </td></tr>
<?php }
//Краи Албуми
?>






        <tr><td><font size=4>Песни: </font><br><br>

<?php if(isset ($pesni)) foreach ($pesni as $v) { ?>
	<a href="browse.php?id=<?php echo $v['id']; ?>"><?php echo htmlspecialcharsX($v['title']); ?>
	<?php if($v['text_bg']) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/prevod.gif" ALT="Има превод"><?php } ?>
	</a><br><br>
	<?php } ?>


        </td></tr></table>



<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
