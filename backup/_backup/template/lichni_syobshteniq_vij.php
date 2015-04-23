<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<i>Съобщения по-стари от 90 дни се трият</i>
<br><br>


<h1><?php echo $ls['otnosno']; ?></h1>
от: <b><a href="profile.php?profile=<?php echo $ls['ot']; ?>"><?php echo $ls['ot_ime']; ?></a></b><br>
на: <?php echo $ls['data']; ?><br>

<div class="bb_code_text"><?php echo $ls['text']; ?></div>

<br><br>
<u><b><a href="lichnosyobshtenie_send.php?za=<?php echo $ls['ot']; ?>&otnosno=<?php echo urlencode('отг: ' . $ls['otnosno_bezhtmlsp']); ?>">отговори</a></b></u>

<?php if (!empty($conversationHistory)) : ?>
	<div style="font-size: 20px;">
		История на кореспонденцията
	</div>

	<?php foreach ($conversationHistory as $c): ?>
		<div style="padding: 10px 0 0 10px;">
			на: <?php echo $c['data']; ?>, <?php echo htmlspecialcharsX($c['username']); ?> написа:<br>
			<div class="bb_code_text"><?php echo $c['text']; ?></div>
		</div>
	<?php endforeach; ?>

<?php endif; ?>


<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>